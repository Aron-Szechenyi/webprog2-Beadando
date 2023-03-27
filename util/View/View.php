<?php

declare(strict_types=1);

namespace Util\View;
class View
{
    public function __construct()
    {
        return $this;
    }

    public function render(string $template_name, array $key_values = [], array $booleans = []): void
    {
        $path = $this->getPath($template_name);

        if (!file_exists($path)) {
            exit();
        }

        $context = file_get_contents($path);

        $sections = [];
        preg_match_all("/{%(.*?)%}/", $context, $sections); // this provides a matrix which contains the whole text, and the text in between the tags

        [$tag, $filename] = $sections;

        for ($i = 0; $i < count($tag); $i++) {
            $subContext = file_get_contents($this->getPath($filename[$i]));
            $tag[$i] = '{' . $tag[$i] . '}'; //single curly braces get swallowed with the evaluation of preg_math_all, so had to rewrite them
            $context = preg_replace($tag[$i], $subContext, $context);    //   {% template_in_template %}
        }

        foreach ($key_values as $key => $value) {
            $context = preg_replace('/\{{' . $key . '}}/', $value, $context); // {{ value_to_be_written_out }}
        }

        /*
         * no clue how to evaluate something like this {! foo>3 !}
         * cuz only the last $key=>$value are in reach for the eval()
         * so this is good for now
         */
        foreach ($booleans as $key => $value) {
            if ($value)
                $context = preg_replace('/\{! if(.*?)' . $key . ' (.*?)!}/', '<?php if (true) : ?>', $context);
            else
                $context = preg_replace('/\{! if(.*?)' . $key . ' (.*?)!}/', '<?php if (false) : ?>', $context);
            $context = preg_replace('/\{! else !}/', '<?php else : ?>', $context);
            $context = preg_replace('/\{! endif !}/', '<?php endif; ?>', $context);
        }

        eval(' ?>' . $context . '<?php ');
    }

    private function getPath(string $filename): string
    {
        $filename = trim($filename);
        return "view/$filename.html";
    }

}
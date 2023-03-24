<?php

declare(strict_types=1);

namespace Util\View;
class View
{
    public function __construct()
    {
        return $this;
    }
    public function render(string $template_name,array $key_values=[]) : void
    {
        $path = $this->getPath($template_name);

        if(!file_exists($path)){
            exit();
        }

        $context = file_get_contents($path);

        $sections=[];
        preg_match_all("/{%(.*?)%}/",$context, $sections); // this provides a matrix which contains the whole text, and the text in between the tags

        [$tag,$filename] = $sections;

        for ($i=0; $i< count($tag);$i++)
        {
            $subContext = file_get_contents($this->getPath($filename[$i]));
            $tag[$i] = '{'.$tag[$i].'}'; //single curly braces get swallowed with the evaluation of preg_math_all, so had to rewrite them
            $context = preg_replace($tag[$i],$subContext,$context);
        }

        foreach ($key_values as $key=>$value)
        {
            $context = preg_replace('/\{{'.$key.'}}/',$value,$context);
        }
        eval(' ?>'.$context.'<?php ');
    }

    private function getPath($filename):string
    {
        $filename = trim($filename);
        return "view/$filename.html";
    }

}
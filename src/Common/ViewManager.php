<?php

namespace SimpleConverter\Common;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewManager
{
    public static function render($template, array $context = [])
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../views');
        $twig = new Environment($loader);

        return $twig->render($template, $context);
    }
}

<?php

namespace SimpleConverter\Temperature\Controller;

use SimpleConverter\Common\ViewManager;

final class TemperatureConverterController
{
    public static function sampleRoute()
    {
        return ViewManager::render('sample.html.twig');
    }
}

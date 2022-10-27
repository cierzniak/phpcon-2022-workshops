<?php

namespace SimpleConverter\Temperature\Controller;

use SimpleConverter\Common\ViewManager;
use SimpleConverter\Temperature\Model\Temperature;
use SimpleConverter\Temperature\Model\Unit;
use SimpleConverter\Temperature\Service\TemperatureConverter;

final class TemperatureConverterController
{
    public static function converterForm()
    {
        return ViewManager::render('temperature/form.html.twig');
    }

    public static function convert()
    {
        $from = new Temperature((float) $_POST['convert_from__value'], new Unit($_POST['convert_from__unit']));
        $toUnit = new Unit($_POST['convert_to__unit']);

        $result = (new TemperatureConverter())->convert($from, $toUnit);

        return ViewManager::render('temperature/form.html.twig', [
            'result' => ['from' => $from, 'to' => $result],
        ]);
    }
}

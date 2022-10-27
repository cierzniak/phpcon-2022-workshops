<?php

namespace SimpleConverter\Temperature\Strategy;

use SimpleConverter\Temperature\Model\Temperature;
use SimpleConverter\Temperature\Model\Unit;

interface TemperatureConverterInterface
{
    public static function unit(Unit $unit): bool;


}

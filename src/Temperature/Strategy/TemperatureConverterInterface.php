<?php

namespace SimpleConverter\Temperature\Strategy;

use SimpleConverter\Temperature\Model\Temperature;
use SimpleConverter\Temperature\Model\Unit;

interface TemperatureConverterInterface
{
    public static function unit(Unit $unit): bool;
    public static function toKelvin(Temperature $temperature): Temperature;
    public static function fromKelvin(Temperature $temperature): Temperature;
}

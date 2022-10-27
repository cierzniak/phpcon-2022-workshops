<?php

namespace SimpleConverter\Temperature\Strategy;

use SimpleConverter\Temperature\Exception\WrongUnitException;
use SimpleConverter\Temperature\Model\Temperature;
use SimpleConverter\Temperature\Model\Unit;

final class KelvinConverter implements TemperatureConverterInterface
{
    public static function unit(Unit $unit): bool
    {
        return Unit::kelwin()->equals($unit);
    }

    public static function toKelvin(Temperature $temperature): Temperature
    {
        if (!self::unit(Unit::kelwin())) {
            throw new WrongUnitException();
        }

        return $temperature;
    }

    public static function fromKelvin(Temperature $temperature): Temperature
    {
        if (!self::unit(Unit::kelwin())) {
            throw new WrongUnitException();
        }

        return $temperature;
    }
}

<?php

namespace SimpleConverter\Temperature\Strategy;

use SimpleConverter\Temperature\Exception\WrongUnitException;
use SimpleConverter\Temperature\Model\Temperature;
use SimpleConverter\Temperature\Model\Unit;

final class CelsiusConverter implements TemperatureConverterInterface
{
    private const KELVIN_TO_CELSIUS_OFFSET = 273.15;

    public static function unit(Unit $unit): bool
    {
        return Unit::celsius()->equals($unit);
    }

    public static function toKelvin(Temperature $temperature): Temperature
    {
        if (!self::unit($temperature->getUnit())) {
            throw new WrongUnitException();
        }

        return new Temperature($temperature->getTemperature() + self::KELVIN_TO_CELSIUS_OFFSET, Unit::kelwin());
    }

    public static function fromKelvin(Temperature $temperature): Temperature
    {
        if (!Unit::kelwin()->equals($temperature->getUnit())) {
            throw new WrongUnitException();
        }

        return new Temperature($temperature->getTemperature() - self::KELVIN_TO_CELSIUS_OFFSET, Unit::celsius());
    }
}

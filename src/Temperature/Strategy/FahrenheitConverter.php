<?php

namespace SimpleConverter\Temperature\Strategy;

use SimpleConverter\Temperature\Exception\WrongUnitException;
use SimpleConverter\Temperature\Model\Temperature;
use SimpleConverter\Temperature\Model\Unit;

final class FahrenheitConverter implements TemperatureConverterInterface
{
    private const KELVIN_TO_FAHRENHEIT_OFFSET = 459.67;
    private const KELVIN_TO_FAHRENHEIT_RATIO = 5 / 9;
    private const FAHRENHEIT_TO_KELVIN_RATIO = 9 / 5;

    public static function unit(Unit $unit): bool
    {
        return Unit::fahrenheit()->equals($unit);
    }

    public static function toKelvin(Temperature $temperature): Temperature
    {
        if (!self::unit($temperature->getUnit())) {
            throw new WrongUnitException();
        }

        return new Temperature(($temperature->getTemperature() + self::KELVIN_TO_FAHRENHEIT_OFFSET) * self::KELVIN_TO_FAHRENHEIT_RATIO, Unit::kelwin());
    }

    public static function fromKelvin(Temperature $temperature): Temperature
    {
        if (!Unit::kelwin()->equals($temperature->getUnit())) {
            throw new WrongUnitException();
        }

        return new Temperature(($temperature->getTemperature() * self::FAHRENHEIT_TO_KELVIN_RATIO) - self::KELVIN_TO_FAHRENHEIT_OFFSET, Unit::fahrenheit());
    }
}

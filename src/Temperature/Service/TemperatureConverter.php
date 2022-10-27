<?php

namespace SimpleConverter\Temperature\Service;

use RuntimeException;
use SimpleConverter\Temperature\Exception\BelowAbsoluteZeroException;
use SimpleConverter\Temperature\Model\Temperature;
use SimpleConverter\Temperature\Model\Unit;
use SimpleConverter\Temperature\Strategy\CelsiusConverter;
use SimpleConverter\Temperature\Strategy\FahrenheitConverter;
use SimpleConverter\Temperature\Strategy\KelvinConverter;

class TemperatureConverter
{
    private const AVAILABLE_CONVERTERS = [
        KelvinConverter::class,
        CelsiusConverter::class,
        FahrenheitConverter::class
    ];

    public function convert(Temperature $base, Unit $targetUnit): Temperature
    {
        $kelvin = $this->toBase($base);
        if ($kelvin->getTemperature() < 0) {
            throw new BelowAbsoluteZeroException();
        }

        return $this->toTarget($kelvin, $targetUnit);
    }

    /**
     * @psalm-return CelsiusConverter::class|FahrenheitConverter::class|KelvinConverter::class
     */
    private function getStrategy(Unit $unit): string
    {
        foreach (self::AVAILABLE_CONVERTERS as $strategy) {
            if ($strategy::unit($unit)) {
                return $strategy;
            }
        }

        throw new RuntimeException('No strategy found');
    }

    private function toBase(Temperature $temperature): Temperature
    {
        $strategy = $this->getStrategy($temperature->getUnit());

        return $strategy::toKelvin($temperature);
    }

    private function toTarget(Temperature $kelvin, Unit $target): Temperature
    {
        $strategy = $this->getStrategy($target);

        return $strategy::fromKelvin($kelvin);
    }
}

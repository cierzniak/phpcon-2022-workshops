<?php

namespace SimpleConverter\Temperature\Model;

final class Temperature
{
    private const PRINT_PRECISION = 2;

    private $temperature;
    private $unit;

    public function __construct(float $temperature, Unit $unit)
    {
        $this->temperature = $temperature;
        $this->unit = $unit;
    }

    public function __toString(): string
    {
        $temp = round($this->temperature, self::PRINT_PRECISION);

        return "{$temp} {$this->unit->toDisplay()}";
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getUnit(): Unit
    {
        return $this->unit;
    }
}

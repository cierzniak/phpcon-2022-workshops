<?php

namespace SimpleConverter\Temperature\Model;

use SimpleConverter\Temperature\Exception\WrongUnitException;

final class Unit
{
    const UNITS = [
        'K' => 'K',
        'C' => '&deg;C',
        'F' => '&deg;F',
    ];

    private string $unit;

    public static function kelwin(): self
    {
        return new self('K');
    }

    public static function celsius(): Unit
    {
        return new Unit('C');
    }

    public static function fahrenheit(): self
    {
        return new self('F');
    }

    public function __construct(string $unit)
    {
        self::validate($unit);
        $this->unit = $unit;
    }

    public function toDisplay(): string
    {
        return self::UNITS[$this->unit];
    }

    public function equals(self $compare): bool
    {
        return $this->unit === $compare->unit;
    }

    private static function validate(string $unit): void
    {
        if (!array_key_exists($unit, self::UNITS)) {
            throw new WrongUnitException();
        }
    }
}

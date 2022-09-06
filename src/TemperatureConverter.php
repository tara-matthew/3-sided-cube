<?php

namespace App;

use App\Enums\Unit;
use Exception;

class TemperatureConverter
{
    protected float $value;
    protected string $unit;

    public const CELSIUS_MULTIPLIER = 9 / 5;
    public const FAHRENHEIT_MULTIPLIER = 5 / 9;
    public const ADDITION_SUBTRACTION_VALUE = 32;
    public const DECIMAL_PLACES = 2;

    /**
     * @param float $value
     * @param string $unit
     */
    public function __construct(float $value, string $unit)
    {
        $this->value = $value;
        $this->unit = $unit;
    }

    /**
     * Converts a float value
     * @return float
     * @throws Exception
     */
    public function convert(): float
    {
        return match ($this->unit) {
            Unit::CELSIUS->value => round(
                ($this->value * self::CELSIUS_MULTIPLIER)
                + self::ADDITION_SUBTRACTION_VALUE,
                self::DECIMAL_PLACES
            ),
            Unit::FAHRENHEIT->value => round(
                ($this->value - self::ADDITION_SUBTRACTION_VALUE)
                * self::FAHRENHEIT_MULTIPLIER,
                self::DECIMAL_PLACES
            ),
            // Shouldn't get this far, but just in case
            default => throw new Exception('Unknown unit passed in'),
        };
    }
}

<?php

namespace App\Tests;

use App\Enums\Unit;
use App\TemperatureConverter;
use Exception;
use PHPUnit\Framework\TestCase;

class TemperatureConverterTest extends TestCase
{
    /**
     * @test
     * @covers \App\TemperatureConverter
     * @return void
     * @throws Exception
     */
    public function returnsConvertedTemperatureCelsiusToFahrenheit(): void
    {
        $temperatureConverter = new TemperatureConverter(20, Unit::CELSIUS->value);
        $expectedResult = 68;
        $result = $temperatureConverter->convert();

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     * @covers \App\TemperatureConverter
     * @return void
     * @throws Exception
     */
    public function returnsConvertedTemperatureFahrenheitToCelsius(): void
    {
        $temperatureConverter = new TemperatureConverter(61, Unit::FAHRENHEIT->value);
        $expectedResult = 16.11;
        $result = $temperatureConverter->convert();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @test
     * @covers \App\TemperatureConverter
     * @return void
     * @throws Exception
     */
    public function returnsConvertedTemperatureToCorrectDecimalPlacesWhenFloatWithMoreDecimalsPassedIn(): void
    {
        $temperatureConverter = new TemperatureConverter(61.312, Unit::FAHRENHEIT->value);
        $expectedResult = 16.28;
        $result = $temperatureConverter->convert();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @test
     * @covers \App\TemperatureConverter
     * @return void
     * @throws Exception
     */
    public function convertsSubZeroTemperatures(): void
    {
        $temperatureConverter = new TemperatureConverter(-4, Unit::CELSIUS->value);
        $expectedResult = 24.8;
        $result = $temperatureConverter->convert();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @test
     * @return void
     * @throws Exception
    */
    public function throwsExceptionWhenInvalidUnitUsed(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Unknown unit passed in');

        $temperatureConverter = new TemperatureConverter(-4, 'a-pretend-unit');
        $temperatureConverter->convert();
    }
}

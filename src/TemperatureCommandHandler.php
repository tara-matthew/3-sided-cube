<?php

namespace App;

use App\Enums\Unit;
use App\Traits\EnumToArrayTrait;
use App\Traits\QuestionTrait;
use Exception;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Webmozart\Console\Api\Args\Args;
use Webmozart\Console\Api\IO\IO;

class TemperatureCommandHandler
{
    use QuestionTrait;
    use EnumToArrayTrait;

    public const SUPPORTED_UNITS = [Unit::CELSIUS, Unit::FAHRENHEIT];
    public const UNITS = [Unit::CELSIUS, Unit::FAHRENHEIT, Unit::UNICORN];

    public const QUESTION = "Is your temperature in Celsius or Fahrenheit? This defaults to Celsius, " .
                            "and please note that there's a bug in our system which" .
                            " sometimes causes unsupported units to display." .
                            " Don't choose one of those unless you're prepared to be disappointed.";

    /**
     * @param Args $args
     * @param IO $io
     * @return int
     * @throws Exception
     */
    public function handle(Args $args, IO $io): int
    {
        $question = new ChoiceQuestion(
            self::QUESTION,
            $this->getEnumValues(self::UNITS),
            '0'
        );

        $unit = $this->ask($args, $io, $question);

        if (!$this->isSupportedUnit($unit)) {
            throw new Exception(
                "We regret to inform you that $unit is not (yet) supported. Could not source a $unit."
            );
        }

        $value = $args->getArgument(TemperatureConverterApplicationConfig::TEMPERATURE);

        $converter = new TemperatureConverter($value, $unit);
        $convertedTemperature = $converter->convert();

        $io->writeLine("Converted from $unit. Your temperature is $convertedTemperature.");

        return 0;
    }

    /**
     * Checks whether the unit passed in is supported by the application
     * @param $unit
     * @return bool
     */
    private function isSupportedUnit($unit): bool
    {
        return in_array($unit, $this->getEnumValues(self::SUPPORTED_UNITS));
    }
}

<?php

namespace App;

use Webmozart\Console\Api\Args\Format\Argument;
use Webmozart\Console\Config\DefaultApplicationConfig;

class TemperatureConverterApplicationConfig extends DefaultApplicationConfig
{
    public const TEMPERATURE = 'temperature';
    public const COMMAND_NAME = 'convert-temperature';
    public const COMMAND_DESCRIPTION = 'Convert a temperature from Celsius to Fahrenheit or vice versa';
    public const ARGUMENT_DESCRIPTION = 'The temperature value';

    /**
     * @return void
     */
    protected function configure(): void
    {
        parent::configure();

        $this
        ->beginCommand(self::COMMAND_NAME)
        ->setDescription(self::COMMAND_DESCRIPTION)
            ->addArgument(self::TEMPERATURE, Argument::REQUIRED, self::ARGUMENT_DESCRIPTION)
        ->setName(self::COMMAND_NAME)
            ->setHandler(function () {
                return new TemperatureCommandHandler();
            });
    }
}

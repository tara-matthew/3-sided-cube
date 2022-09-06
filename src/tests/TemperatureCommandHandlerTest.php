<?php

namespace App\Tests;

use App\TemperatureCommandHandler;
use App\Traits\EnumToArrayTrait;
use Exception;
use PHPUnit\Framework\TestCase;
use Webmozart\Console\Api\Args\Args;
use Webmozart\Console\Api\Args\Format\ArgsFormat;
use Webmozart\Console\Api\Args\Format\Argument;
use Webmozart\Console\Api\IO\Input;
use Webmozart\Console\Api\IO\IO;
use Webmozart\Console\Api\IO\Output;
use Webmozart\Console\Args\StringArgs;
use Webmozart\Console\IO\InputStream\StringInputStream;
use Webmozart\Console\IO\OutputStream\BufferedOutputStream;

class TemperatureCommandHandlerTest extends TestCase
{
    use EnumToArrayTrait;

    protected Input $input;
    protected Output $output;
    protected Output $errorOutput;
    protected IO $io;
    protected TemperatureCommandHandler $temperatureHandler;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->input = new Input(new StringInputStream());
        $this->output = new Output(new BufferedOutputStream());
        $this->errorOutput = new Output(new BufferedOutputStream());
        $this->io = new IO($this->input, $this->output, $this->errorOutput);
        $this->temperatureHandler = new TemperatureCommandHandler();
    }

    /**
     * @return void
     * @throws Exception
     */
    protected function setUpHandler(): void
    {
        $rawArgs = new StringArgs('convert-temperature, --, 5');
        $argsFormat = ArgsFormat::build()
            ->addArgument(new Argument('temperature', Argument::OPTIONAL, 'The description', 25))
            ->getFormat();

        $args = new Args($argsFormat, $rawArgs);

        $this->temperatureHandler->handle($args, $this->io);
    }

    /**
     * @test
     * @covers \App\TemperatureCommandHandler
     * @return void
     * @throws Exception
     */
    public function displaysCompleteUnitSelection(): void
    {
        $this->setUpHandler();
        $measurements = $this->getEnumValues(TemperatureCommandHandler::UNITS);

        $outputStream = $this->io->getOutput()->getStream()->fetch();

        foreach ($measurements as $measurement) {
            $this->assertStringContainsString($measurement, $outputStream);
        }
    }
}

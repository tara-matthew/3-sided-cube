<?php

namespace App\Traits;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Question\Question;
use Webmozart\Console\Adapter\ArgsInput;
use Webmozart\Console\Adapter\IOOutput;
use Webmozart\Console\Api\Args\Args;
use Webmozart\Console\Api\IO\IO;

trait QuestionTrait
{
    /**
     * @param Args $args
     * @param IO $io
     * @param Question $question
     * @return bool|mixed|string|null
     */
    public function ask(Args $args, IO $io, Question $question): mixed
    {
        $helper = new QuestionHelper();

        return $helper->ask(new ArgsInput($args->getRawArgs(), $args), new IOOutput($io), $question);
    }
}

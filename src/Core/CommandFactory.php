<?php

/**
 * CommandFactory
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Core;


use Slonyaka\OpencartCli\Command\Command;
use Slonyaka\OpencartCli\Command\NullCommand;

class CommandFactory
{
    private $commands;

    public function __construct()
    {
        $this->commands = config('commands');
    }

    public function __invoke(): Command
    {
        $command = request()->getCommand();
        if ($this->commandExists($command)) {
            return new $this->commands[$command];
        }

        return new NullCommand();
    }

    private function commandExists(string $command): bool
    {
        return !empty($this->commands[$command]);
    }
}

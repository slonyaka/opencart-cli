<?php

/**
 * CommandFactory
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Core;


use Slonyaka\OpencartCli\Command\Command;
use Slonyaka\OpencartCli\Command\NullCommand;
use Slonyaka\OpencartCli\Exception\ContainerException;

class CommandFactory
{
    private $commands;

    public function __construct()
    {
        $this->commands = config('commands');
    }

    /**
     * @throws ContainerException
     */
    public function __invoke(): Command
    {
        $command = request()->getCommand();
        if ($this->commandExists($command)) {
            return app($this->commands[$command]);
        }

        return new NullCommand();
    }

    private function commandExists(string $command): bool
    {
        return !empty($this->commands[$command]);
    }
}

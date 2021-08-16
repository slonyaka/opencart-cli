<?php

/**
 * Kernel
 * @author sergey.slonchakov
 */

namespace Slonyaka\OpencartCli\Core;

class Kernel
{

    /**
     * @var Request
     */
    private $request;

    public function __construct(ConsoleRequest $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $commandFactory = new CommandFactory();
        $command = $commandFactory($this->request->getCommand());
        $command->run($this->request);
    }
}

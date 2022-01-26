<?php

/**
 * Kernel
 * @author sergey.slonchakov
 */

namespace Slonyaka\OpencartCli\Core;

use Slonyaka\OpencartCli\Exception\ContainerException;

class Kernel
{
    /**
     * @throws ContainerException
     */
    public function handle()
    {
        $commandFactory = app(CommandFactory::class);
        $command = $commandFactory();
        $command->run();
    }
}

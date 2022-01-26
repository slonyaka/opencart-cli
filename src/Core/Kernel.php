<?php

/**
 * Kernel
 * @author sergey.slonchakov
 */

namespace Slonyaka\OpencartCli\Core;

class Kernel
{
    /**
     * @throws \ReflectionException
     * @throws \Slonyaka\OpencartCli\Exception\ContainerException
     */
    public function handle()
    {
        $commandFactory = app(CommandFactory::class);
        $command = $commandFactory();
        $command->run();
    }
}

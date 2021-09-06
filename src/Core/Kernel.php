<?php

/**
 * Kernel
 * @author sergey.slonchakov
 */

namespace Slonyaka\OpencartCli\Core;

class Kernel
{
    public function handle()
    {
        $commandFactory = app(CommandFactory::class);
        $command = $commandFactory();
        $command->run();
    }
}

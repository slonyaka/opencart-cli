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
    public function handle(): Output
    {
        /**
         * @var CommandFactory $commandFactory
         */
        $commandFactory = app(CommandFactory::class);
        return $commandFactory()->run();
    }
}

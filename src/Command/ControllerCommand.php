<?php

/**
 * ControllerCommand
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Command;


use Exception;
use Slonyaka\OpencartCli\Exception\CommandException;
use Slonyaka\OpencartCli\Service\ControllerService;
use Slonyaka\OpencartCli\Service\Options\ServiceOptions;

class ControllerCommand implements Command
{

    /**
     * @throws Exception
     */
    public function run()
    {
        $service = app(ControllerService::class);
        $options = app(ServiceOptions::class);

        if (!$options->hasOption('name')) {
            throw new CommandException('name is required');
        }

        $service->process($options);

        echo 'controller has been generated';

        /**
         * TODO Add eventDispatcher->dispatch
         */
    }
}
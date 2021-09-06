<?php

/**
 * ControllerCommand
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Command;


use Slonyaka\OpencartCli\Core\EntityType;
use Slonyaka\OpencartCli\Service\ControllerService;

class ControllerCommand implements Command
{

    public function run()
    {
        $request = request();
        $service = app(ControllerService::class);

        $name = $request->getArgument('name');

        if (!$name) {
            throw new \Exception('name is required');
        }

        $type = $request->getOption('type') ?? EntityType::TYPE_CONTROLLER;

        $service->process($name, $type, $request->getOption('lang'), $request->getOption('tpl'), $request->getOption('dir'));

        echo 'controller has been generated';

        /**
         * TODO Add eventDispatcher->dispatch
         */
    }
}
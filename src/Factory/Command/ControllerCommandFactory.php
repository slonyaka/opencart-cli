<?php

namespace Slonyaka\OpencartCli\Factory\Command;

use Slonyaka\OpencartCli\Command\ControllerCommand;
use Slonyaka\OpencartCli\Exception\ContainerException;
use Slonyaka\OpencartCli\Factory\InvokableFactory;
use Slonyaka\OpencartCli\Service\ControllerService;

class ControllerCommandFactory extends InvokableFactory
{
    /**
     * @throws ContainerException
     */
    public function __invoke(): ControllerCommand
    {
        return new ControllerCommand(app(ControllerService::class));
    }

}

<?php

/**
 * ControllerCommand
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Command;


use Slonyaka\OpencartCli\Core\ConsoleRequest;

class ControllerCommand implements Command
{

    public function run(ConsoleRequest $request)
    {
        echo 'this is make:controller command';
    }
}
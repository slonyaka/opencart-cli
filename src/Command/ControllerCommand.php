<?php

/**
 * ControllerCommand
 * @author sergey.slonchakov/centum-d
 */


namespace Slonyaka\OpencartCli\Command;


use Slonyaka\OpencartCli\Core\Request;

class ControllerCommand implements Command
{

    public function run(Request $request)
    {
        echo 'this is make:controller command';
    }
}
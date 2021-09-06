<?php

/**
 * InvokableFactory
 * @author sergey.slonchakov/centum-d
 */


namespace Slonyaka\OpencartCli\Factories;


class InvokableFactory
{
    public function __invoke($classname)
    {
        return new $classname();
    }
}
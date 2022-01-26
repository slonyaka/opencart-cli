<?php

/**
 * ServiceOptionsFactory
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Factory;


use Slonyaka\OpencartCli\Service\Options\ServiceOptions;

class ServiceOptionsFactory extends InvokableFactory
{
    public function __invoke(): ServiceOptions
    {
        return new $this->className(request()->all());
    }
}
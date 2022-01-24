<?php

/**
 * ServiceOptionsFactory
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Factories;


use Slonyaka\OpencartCli\Service\Options\ServiceOptions;

class ServiceOptionsFactory
{
    public function __invoke(): ServiceOptions
    {
        return new $this->className(request()->all());
    }
}

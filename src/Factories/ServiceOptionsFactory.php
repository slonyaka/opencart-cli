<?php

/**
 * ServiceOptionsFactory
 * @author sergey.slonchakov/centum-d
 */


namespace Slonyaka\OpencartCli\Factories;


use Slonyaka\OpencartCli\Service\Options\ServiceOptions;

class ServiceOptionsFactory
{
    public function __invoke(): ServiceOptions
    {
        return new ServiceOptions(request()->all());
    }
}

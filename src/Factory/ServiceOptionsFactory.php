<?php

/**
 * ServiceOptionsFactory
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Factory;


use Slonyaka\OpencartCli\Exception\ContainerException;
use Slonyaka\OpencartCli\Service\Options\ServiceOptions;

class ServiceOptionsFactory extends InvokableFactory
{
    /**
     * @throws ContainerException
     */
    public function __invoke(): ServiceOptions
    {
        return new $this->className(request()->all());
    }
}

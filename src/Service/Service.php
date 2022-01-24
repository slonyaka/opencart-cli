<?php

/**
 * Service
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Service;


use Slonyaka\OpencartCli\Service\Options\ServiceOptions;

interface Service
{
    public function process(ServiceOptions $options);
}
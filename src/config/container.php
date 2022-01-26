<?php

use Slonyaka\OpencartCli\Factory\InvokableFactory;
use Slonyaka\OpencartCli\Factory\ServiceOptionsFactory;
use Slonyaka\OpencartCli\Service\Options\ServiceOptions;

/**
 *
 * Dependency Injection Container Config.
 *
 * Implemented with invokable factories.
 * If class instance needs parameters, they should be provided in factory.
 * Slonyaka\OpencartCli\Factory\InvokableFactoryInterface
 *
 */
return [
    ServiceOptions::class => ServiceOptionsFactory::class,
];

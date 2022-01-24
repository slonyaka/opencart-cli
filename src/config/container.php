<?php

use Slonyaka\OpencartCli\Factories\ServiceOptionsFactory;
use Slonyaka\OpencartCli\Service\Options\ServiceOptions;

/**
 *
 * Dependency Injection Container Config.
 *
 * Implemented with invokable factories.
 * If class instance needs parameters, they should be provided in factory.
 *
 * class InvokableFactory {
 * public function __invoke(){}
 * }
 *
 */
return [
    ServiceOptions::class => ServiceOptionsFactory::class
];

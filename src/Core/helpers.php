<?php


use Slonyaka\OpencartCli\Core\Config;
use Slonyaka\OpencartCli\Core\ConsoleRequest;
use Slonyaka\OpencartCli\Core\Container;

if (!function_exists('config')) {
    function config($key)
    {
        return Config::getInstance()->get($key);
    }
}

if (!function_exists('app')) {
    function app($classname = null)
    {
        $container = Container::getInstance();
        if (!$classname) {
            return $container;
        }

        return $container->get($classname);
    }
}


if (!function_exists('request')) {
    function request(): ConsoleRequest
    {
        $container = Container::getInstance();
        return $container->get(ConsoleRequest::class);
    }
}

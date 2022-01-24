<?php


use Slonyaka\OpencartCli\Core\Config;
use Slonyaka\OpencartCli\Core\ConsoleRequest;
use Slonyaka\OpencartCli\Core\Container;
use Slonyaka\OpencartCli\Exception\ContainerException;

if (!function_exists('config')) {
    function config($key)
    {
        return Config::getInstance()->get($key);
    }
}

if (!function_exists('app')) {
    /**
     * @throws ReflectionException
     * @throws ContainerException
     */
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
        return app(ConsoleRequest::class);
    }
}

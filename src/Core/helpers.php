<?php


use Slonyaka\OpencartCli\Core\Config;
use Slonyaka\OpencartCli\Core\ConsoleRequest;
use Slonyaka\OpencartCli\Core\Container;
use Slonyaka\OpencartCli\Core\Output;
use Slonyaka\OpencartCli\Exception\ContainerException;

if (!function_exists('config')) {
    function config($key)
    {
        return Config::getInstance()->get($key);
    }
}

if (!function_exists('app')) {
    /**
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
    /**
     * @throws ContainerException
     */
    function request(): ConsoleRequest
    {
        return app(ConsoleRequest::class);
    }
}

if (!function_exists('output')) {
    /**
     * @throws ContainerException
     */
    function output($string = null): Output
    {
        $output = app(Output::class);
        if ($string) {
            $output->set($string);
        }
        return $output;
    }
}
<?php


use Slonyaka\OpencartCli\Core\Config;

if (!function_exists('config')) {
    function config($key)
    {
        return Config::getInstance()->get($key);
    }
}
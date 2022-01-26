<?php

/**
 * Config
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Core;


class Config
{
    private static ?Config $instance = null;

    private array $config;

    private function __construct(array $config)
    {
        $this->config = $config;
    }

    public static function getInstance(): self
    {
        if (self::$instance) {
            return self::$instance;
        }

        $config = [];

        foreach (glob(__DIR__ . '/../config/*.php') as $configFile) {
            $config[basename($configFile, '.php')] = include_once($configFile);
        }

        return self::$instance = new self($config);
    }

    public function get($key)
    {
        if (strpos($key, '.') === false) {
            return $this->config[$key] ?? false;
        }

        $items = explode('.', $key);
        $result = $this->config;

        foreach ($items as $index) {
            if (empty($result[$index])) {
                return false;
            }

            $result = $result[$index];
        }

        return $result;
    }
}

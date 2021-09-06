<?php

/**
 * ServiceContainer
 * @author sergey.slonchakov/centum-d
 */


namespace Slonyaka\OpencartCli\Core;


class Container
{
    private static $instance;

    private $pool = [];

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function singleton($classname, $factory = null)
    {
        $instance = $factory() ?? new $classname();
        $this->pool[$classname] = $instance;
    }

    public function add($classname, $instance)
    {
        $this->pool[$classname] = $instance;
    }

    public function get($classname)
    {
        if (!empty($this->pool[$classname])) {
            return $this->pool[$classname];
        }

        return new $classname();
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }
}

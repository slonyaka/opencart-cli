<?php

/**
 * ServiceContainer
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Core;


use Exception;
use Slonyaka\OpencartCli\Exception\ContainerException;
use Slonyaka\OpencartCli\Factory\InvokableFactory;
use Slonyaka\OpencartCli\Factory\InvokableFactoryInterface;

class Container
{
    private static ?Container $instance = null;

    private array $pool = [];

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

    /**
     * @throws ContainerException
     */
    public function get($classname)
    {
        if (!empty($this->pool[$classname])) {
            return $this->pool[$classname];
        }

        $factories = config('container');

        if(key_exists($classname, $factories)) {
            $factory = $factories[$classname];

            /**
             * @var InvokableFactory $factoryInstance
             */
            $factoryInstance = new $factory($classname);

            if (!$factoryInstance instanceof InvokableFactoryInterface) {
                throw new ContainerException('Factory must implement InvokableFactoryInterface');
            }

            return $factoryInstance();
        }

        if (class_exists($classname)) {
            $rc = new \ReflectionClass($classname);
            if (
                $rc->hasMethod('__construct')
                && $rc->getMethod('__construct')->getNumberOfRequiredParameters()
            ) {
                throw new ContainerException($classname . ' class with parameters in __construct method. It should be instantiated with invokable factory');
            }

            return new $classname();
        }

        throw new ContainerException($classname . ' not found');
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }
}

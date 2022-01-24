<?php

/**
 * ServiceContainer
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Core;


use Exception;
use Slonyaka\OpencartCli\Exception\ContainerException;
use Slonyaka\OpencartCli\Factories\InvokableFactory;
use Slonyaka\OpencartCli\Factories\InvokableFactoryInterface;

class Container
{
    private static ?Container $instance = null;

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

    /**
     * @throws ContainerException
     * @throws \ReflectionException
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

        $rc = new \ReflectionClass($classname);

        if ($rc->getMethod('__construct')->getNumberOfRequiredParameters()) {
            throw new ContainerException('Classes with parameters in __construct method should be instantiated with invokable factory');
        }

        return new $classname();
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

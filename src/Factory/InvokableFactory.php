<?php

/**
 * InvokableFactory
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Factory;


use Slonyaka\OpencartCli\Exception\FactoryException;

class InvokableFactory implements InvokableFactoryInterface
{
    protected ?string $className = null;

    /**
     * @throws FactoryException
     */
    public function __construct(string $className)
    {
        if (!class_exists($className)) {
            throw new FactoryException('Class: ' . $className . ' - does not exist');
        }
        $this->className = $className;
    }

    public function __invoke()
    {
        return new $this->className();
    }
}

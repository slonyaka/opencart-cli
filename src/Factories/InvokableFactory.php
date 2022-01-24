<?php

/**
 * InvokableFactory
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Factories;


class InvokableFactory implements InvokableFactoryInterface
{
    protected ?string $className = null;

    public function __construct(string $className)
    {
        $this->className = $className;
    }

    public function __invoke()
    {
        if ($this->className) {
            return new $this->className();
        }
    }
}

<?php

/**
 * ServiceOptions
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Service\Options;


class ServiceOptions
{

    private array $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function hasOption($name): bool
    {
        return isset($this->options[$name]);
    }

    public function getOption($name)
    {
        return $this->options[$name] ?? null;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}

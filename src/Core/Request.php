<?php

/**
 * Request
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Core;


class Request implements ConsoleRequest
{
    /**
     * @var array
     */
    private $arguments;
    private $command;
    private $options;

    public function __construct(array $arguments)
    {
        $this->command = $arguments[1];

        if (count($arguments) > 2) {
            $this->arguments = array_slice($arguments, 2);

            foreach ($this->arguments as $argument) {
                [$name, $value] = explode('=', $argument);
                if (strpos($name, '--') !== false) {
                    $this->options[$name] = $value;
                } else {
                    $this->arguments[$name] = $value;
                }
            }
        }
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function getArgument(string $name): ?string
    {
        return $this->arguments[$name] ?? null;
    }

    public function getCommand(): string
    {
        return $this->command;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getOption($name): ?string
    {
        return $this->options[$name] ?? null;
    }
}

<?php

/**
 * Request
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Core;


class Request implements ConsoleRequest
{
    private $command;
    private array $arguments = [];
    private array $options = [];

    /**
     * @throws \Exception
     */
    public function __construct(array $arguments)
    {
        if (empty($argument[1])) {
            throw new \Exception('Name of command is required');
        }

        $this->command = $arguments[1];

        if (count($arguments) > 2) {
            $this->arguments = array_slice($arguments, 2);

            foreach ($this->arguments as $argument) {

                if (strpos($argument, '=') !== false) {
                    [$name, $value] = explode('=', $argument);
                } else {
                    $name = $argument;
                    $value = true;
                }

                if (strpos($name, '--') !== false) {
                    $this->options[ltrim($name,'-')] = $value;
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

    public function all(): array
    {
        return array_merge(['command' => $this->getCommand()], $this->getArguments(), $this->getOptions());
    }
}

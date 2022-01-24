<?php

/**
 * PhpOutput
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Output;


class PhpOutput
{

    private $output;
    private $placeholders = [];

    public function __construct()
    {
        $this->output = '<?php' . "\n\n";
    }

    public function appendFromFile($filename): self
    {
        $this->output .= file_get_contents($filename);
        return $this;
    }

    public function addLine($line): self
    {
        $this->output = $line . "\n\n";
        return $this;
    }

    public function append($output): self
    {
        $this->output .= $output;
        return $this;
    }

    public function preparePlaceholders($keys): self
    {
        $this->placeholders = array_map(function($key) {
            return '['. $key .']';
        }, $keys);

        return $this;
    }

    public function fill(array $data): self
    {
        $this->preparePlaceholders(array_keys($data));
        $this->output = str_replace($this->placeholders, array_values($data), $this->output);
        return $this;
    }

    public function get(): string
    {
        return $this->output;
    }

    public function __toString()
    {
        return $this->get();
    }

    public function put(string $controllerPath)
    {
        file_put_contents($controllerPath, $this->output);
    }
}

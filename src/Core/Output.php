<?php

namespace Slonyaka\OpencartCli\Core;

class Output
{
    protected string $output = '';

    public function set($string): Output
    {
        $this->output = $string;
        return $this;
    }

    public function append($string): Output
    {
        $this->output .= $string;
        return $this;
    }

    public function print()
    {
        echo $this->getOutput() . "\n";
    }

    public function getOutput(): string
    {
        return $this->output;
    }
}

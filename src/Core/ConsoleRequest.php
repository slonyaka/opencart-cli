<?php


namespace Slonyaka\OpencartCli\Core;


interface ConsoleRequest
{
    public function getArgument(string $name): ?string;
    public function getCommand(): string;
    public function getOption($name): ?string;
}

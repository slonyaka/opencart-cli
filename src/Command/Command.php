<?php


namespace Slonyaka\OpencartCli\Command;


use Slonyaka\OpencartCli\Core\Output;

interface Command
{
    public function run(): Output;
}

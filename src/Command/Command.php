<?php


namespace Slonyaka\OpencartCli\Command;


use Slonyaka\OpencartCli\Core\Request;

interface Command
{
    public function run(Request $request);
}
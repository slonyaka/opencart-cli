<?php

namespace Slonyaka\OpencartCli\Command;

use Slonyaka\OpencartCli\Exception\ContainerException;
use Slonyaka\OpencartCli\Service\Options\ServiceOptions;

abstract class AbstractCommand implements Command
{

    protected string $signature = 'Signature of command';
    protected string $description = '';

    public function help()
    {
        echo $this->signature . "\n" . $this->description;
    }

    /**
     * @throws ContainerException
     */
    public function run()
    {
        $options = app(ServiceOptions::class);

        if ($options->hasOption('help')) {
            $this->help();
            exit;
        }

        $this->doRun($options);
    }

    abstract public function doRun(ServiceOptions $options);
}

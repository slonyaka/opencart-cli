<?php

namespace Slonyaka\OpencartCli\Command;

use Slonyaka\OpencartCli\Core\Output;
use Slonyaka\OpencartCli\Exception\ContainerException;
use Slonyaka\OpencartCli\Service\Options\ServiceOptions;

abstract class AbstractCommand implements Command
{

    protected string $signature = 'Signature of command';
    protected string $description = '';

    public function help(): string
    {
        return $this->signature . "\n" . $this->description;
    }

    /**
     * @throws ContainerException
     */
    public function run(): Output
    {
        $options = app(ServiceOptions::class);

        if ($options->hasOption('help')) {
            $output = $this->help();
        } else {
            $output = $this->doRun($options);
        }

        return output($output);
    }

    abstract public function doRun(ServiceOptions $options): ?string;
}

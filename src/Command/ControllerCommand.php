<?php

/**
 * ControllerCommand
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Command;


use Slonyaka\OpencartCli\Exception\CommandException;
use Slonyaka\OpencartCli\Exception\ContainerException;
use Slonyaka\OpencartCli\Service\ControllerService;
use Slonyaka\OpencartCli\Service\Options\ServiceOptions;

class ControllerCommand extends AbstractCommand
{
    protected string $signature = 'make:controller [name] --type={controller,extension} --dir={path/to/module} --lang{*hint: include language to controller} --tpl={template_name}';

    protected string $description = '* Generates two types of controllers.';

    private ControllerService $service;

    public function __construct(ControllerService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws CommandException
     * @throws ContainerException
     */
    public function doRun(ServiceOptions $options): ?string
    {
        if (!$options->hasOption('name')) {
            throw new CommandException('name is required');
        }

        $this->service->process($options);

        return 'controller has been generated';

        /**
         * TODO Add eventDispatcher->dispatch
         */
    }
}

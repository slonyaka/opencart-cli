<?php

/**
 * ControllerService
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Service;


use Slonyaka\OpencartCli\Core\EntityType;
use Slonyaka\OpencartCli\Output\PhpOutput;
use Slonyaka\OpencartCli\Service\Options\ServiceOptions;

class ControllerService implements Service
{
    public function process(ServiceOptions $options)
    {
        $name = strtolower($options->getOption('name'));
        $templatesDirectory = config('config.dir.templates');

        $type = $options->getOption('type') ?? EntityType::TYPE_CONTROLLER;

        $data['output'] = file_get_contents(sprintf('%sparts/%s.output.php', $templatesDirectory, $type));

        /**
         * @var PhpOutput $output
         */
        $output = app(PhpOutput::class);
        $output->appendFromFile($templatesDirectory . 'controller.php');

        $loadTo = config('config.dir.projects') . '/catalog/controller/';
        $className = 'Controller';

        if ($type == EntityType::TYPE_EXTENSION) {

            $className .= 'ExtensionModule';
            if ($options->hasOption('dir')) {
                $className .= ucfirst($options->getOption('dir'));
                $dir = 'extension/module/' . $options->getOption('dir') . '/';
            } else {
                $dir = 'extension/module/';
            }
        } else {
            $dir = ($options->getOption('dir') ?? 'product');
            $className .= ucfirst($dir);
            $dir .= '/';
        }

        $loadTo .= $dir;
        $className .= ucfirst($name);
        $data['class'] = $className;

        if ($options->hasOption('lang')) {
            $data['lang'] = '$this->load->language("' . $dir . $name . '");';
        } else {
            $data['lang'] = '';
        }

        if ($options->hasOption('tpl')) {
            $data['view'] = $dir . $name;
        } else {
            $data['view'] = '';
        }

        if (!is_dir($loadTo)) {
            mkdir($loadTo, 0755, true);
        }

        $controllerPath = $loadTo . $name . '.php';
        $output->fill($data)->put($controllerPath);
    }
}

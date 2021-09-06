<?php

/**
 * ControllerService
 * @author sergey.slonchakov/centum-d
 */


namespace Slonyaka\OpencartCli\Service;


use Slonyaka\OpencartCli\Core\EntityType;
use Slonyaka\OpencartCli\Output\PhpOutput;

class ControllerService implements Service
{
    public function process($name, ?string $type, ?bool $lang, ?bool $tpl, ?string $dir)
    {
        $name = strtolower($name);
        $templatesDirectory = config('config.templatesDirectory');

        $data['output'] = file_get_contents(sprintf('%sparts/%s.output.php', $templatesDirectory, $type));

        /**
         * @var PhpOutput $output
         */
        $output = app(PhpOutput::class);
        $output->appendFromFile($templatesDirectory . 'controller.php');

        $loadTo = OC_CLI_ROOT . config('config.projectsDirectory') . '/catalog/controller/';
        $className = 'Controller';

        if ($type == EntityType::TYPE_EXTENSION) {

            $className .= 'ExtensionModule';
            if ($dir) {
                $className .= ucfirst($dir);
                $dir = 'extension/module/' . $dir . '/';
            } else {
                $dir = 'extension/module/';
            }
        } else {
            $dir = ($dir ?? 'product') . '/';
            $className .= ucfirst($dir);
        }

        $loadTo .= $dir;
        $className .= ucfirst($name);
        $data['class'] = $className;

        if ($lang) {
            $data['lang'] = '$this->load->language("' . $dir . $name . '");';
        } else {
            $data['lang'] = '';
        }

        if ($tpl) {
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

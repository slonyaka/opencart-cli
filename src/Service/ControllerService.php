<?php

/**
 * ControllerService
 * @author sergey.slonchakov/centum-d
 */


namespace Slonyaka\OpencartCli\Service;


use Slonyaka\OpencartCli\Core\EntityType;

class ControllerService implements Service
{
    public function process($name, ?string $type, ?bool $lang, ?bool $tpl, ?string $dir)
    {
        $outputPart = $type .'.output.php';

        $data['output'] = file_get_contents(__DIR__ . '/../templates/parts/' . $outputPart);

        $output = '<?php' . "\n\n";
        $output .= file_get_contents(__DIR__ . '/../templates/controller.php');

        $data['className'] = $name;

        $loadTo = OC_CLI_ROOT . '/' . config('config.projectsDirectory') . '/catalog/controller/';
        $className = 'Controller';

        if ($type == EntityType::TYPE_EXTENSION) {
            $loadTo .= 'extension/module/';
            $className .= 'ExtensionModule';
            $dir = 'extension/module/' . $dir;
        } else {
            $dir = $dir ?? 'product';
            $loadTo .= $dir . '/';
            $className .= ucfirst($dir);
        }

        $className .= ucfirst($name);
        $data['class'] = $className;

        if ($lang) {
            $data['lang'] = '$this->load->language("' . $dir . '/' . $name . '");';
        } else {
            $data['lang'] = '';
        }

        if ($tpl) {
            $data['view'] = $dir . '/' . $name;
        } else {
            $data['view'] = '';
        }

        $controllerPath = $loadTo . strtolower($name) . '.php';

        if (!is_dir($loadTo)) {
            mkdir($loadTo, 0755, true);
        }

        $replace = [];

        foreach (array_keys($data) as $key) {
            $replace[] = '['. $key .']';
        }

        file_put_contents($controllerPath, str_replace($replace, array_values($data), $output));
    }
}

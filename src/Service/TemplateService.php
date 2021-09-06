<?php

/**
 * TemplateService
 * @author sergey.slonchakov/centum-d
 */


namespace Slonyaka\OpencartCli\Service;


use Slonyaka\OpencartCli\Service\Options\ServiceOptions;

class TemplateService implements Service
{

    public function process(ServiceOptions $options)
    {
        $templateDir = 'catalog/view/' . (config('config.theme') ?: 'default' ) . '/';
        $templatePath = OC_CLI_ROOT . config('config.projectsDirectory') . '/' . $templateDir;

        if (!is_dir($templatePath)) {
            mkdir($templatePath, 0755, true);
        }

        file_put_contents($templatePath . '/' . strtolower($options->getOption('name')) . '.tpl', '');
    }
}
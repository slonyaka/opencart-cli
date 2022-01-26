<?php

/**
 * NullCommand
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Command;


use Slonyaka\OpencartCli\Core\Output;
use Slonyaka\OpencartCli\Exception\ContainerException;

class NullCommand implements Command
{
    /**
     * @throws ContainerException
     */
    public function run(): Output
    {
        $request = request();
        $output = 'Command ' . $request->getCommand() . ' not found' . "\n";

        $commands = config('commands');

        $similar = [];

        foreach ($commands as $name => $command) {
            similar_text($name, $request->getCommand(), $percent);

            if ($percent > 75) {
                $similar[] = $name;
            }
        }

        if (!empty($similar)) {
            $output .= "maybe you meant:\n";

            foreach ($similar as $similarCommand) {
                $output .= "\t$similarCommand\n";
            }
        }

        return output($output);
    }
}

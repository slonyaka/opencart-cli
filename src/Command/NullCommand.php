<?php

/**
 * NullCommand
 * @author sergey.slonchakov
 */


namespace Slonyaka\OpencartCli\Command;


class NullCommand implements Command
{
    public function run() {
        $request = request();
        echo 'Command ' . $request->getCommand() . ' not found' . "\n";

        $commands = config('commands');

        $similar = [];

        foreach ($commands as $name => $command) {
            similar_text($name, $request->getCommand(), $percent);

            if ($percent > 75) {
                $similar[] = $name;
            }
        }

        if (!empty($similar)) {
            echo "maybe you meant:\n";

            foreach ($similar as $similarCommand) {
                echo "\t$similarCommand\n";
            }
        }
    }
}

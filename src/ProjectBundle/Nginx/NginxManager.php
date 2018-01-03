<?php
/**
 * NginxManager.php
 *
 * @since 07/04/17
 * @author gseidel
 */

namespace ProjectBundle\Nginx;

use Symfony\Component\Process\Process;

class NginxManager
{
    /**
     * @var string
     */
    private $scriptPath;

    public function __construct()
    {
        $this->scriptPath = __DIR__.'/../../../scripts';
    }

    public function restart()
    {
        $command = sprintf('/usr/bin/env bash %s/nginx_restart.bash', $this->scriptPath);
        $process = new Process($command);
        $process->run();
        return $process->getOutput();
    }

    public function compile()
    {
        $command = sprintf('/usr/bin/env bash %s/nginx_compile.bash', $this->scriptPath);
        $process = new Process($command);
        $process->run();
        return $process->getOutput();
    }
}
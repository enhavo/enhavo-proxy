<?php
/**
 * NginxManager.php
 *
 * @since 07/04/17
 * @author gseidel
 */

namespace ProjectBundle\Nginx;

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
        exec($command, $output);
        return $output;
    }
}
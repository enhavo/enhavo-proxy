<?php
/**
 * VarnishManager.php
 *
 * @since 07/04/17
 * @author gseidel
 */

namespace ProjectBundle\Varnish;


use Enhavo\Bundle\AppBundle\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Process\Process;

class VarnishManager
{
    /**
     * @var string
     */
    private $scriptPath;

    /**
     * @var string
     */
    private $secretFilePath;

    /**
     * @var Filesystem
     */
    private $fs;

    public function __construct($secretFilePath, Filesystem $fs)
    {
        $this->scriptPath = __DIR__.'/../../../scripts';
        $this->secretFilePath = $secretFilePath;
        $this->fs = $fs;
    }

    public function restart()
    {
        $command = sprintf('/usr/bin/env bash %s/varnish_restart.bash', $this->scriptPath);
        $process = new Process($command);
        $process->run();
        return $process->getOutput();
    }

    public function compile()
    {
        $command = sprintf('/usr/bin/env bash %s/varnish_compile.bash', $this->scriptPath);
        $process = new Process($command);
        $process->run();
        return $process->getOutput();
    }

    public function testConfig()
    {
        exec('varnishd -C -f /etc/varnish/default.vcl');
    }

    public function createSecretFile()
    {
        $this->fs->dumpFile($this->secretFilePath, uniqid());
    }
}
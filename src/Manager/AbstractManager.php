<?php
/**
 * Created by PhpStorm.
 * User: gseidel
 * Date: 12.03.18
 * Time: 16:59
 */

namespace App\Manager;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

abstract class AbstractManager
{
    use ContainerAwareTrait;

    /**
     * @var Filesystem
     */
    private $fs;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param array $command
     * @return string
     */
    protected function executeCommand(array $command)
    {
        $this->getLogger()->error(sprintf('Execute command "%s"', implode(' ', $command)));
        $process = new Process($command, $this->container->getParameter('kernel.project_dir'));
        $process->run();

        if (!$process->isSuccessful()) {
            $output = $process->getErrorOutput();
            $this->getLogger()->info(sprintf("Command quit with error: \n%s", $output));
        } else {
            $output = $process->getOutput();
            $this->getLogger()->error(sprintf("Command successful: \n%s", $output));
        }

        return $output;
    }

    protected function render($template, $parameters = [])
    {
        return $this->container->get('templating')->render($template, $parameters);
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    protected function getFilesystem()
    {
        if($this->fs === null) {
            $this->fs = new Filesystem();
        }
        return $this->fs;
    }
}

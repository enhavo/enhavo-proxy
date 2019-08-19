<?php
/**
 * Created by PhpStorm.
 * User: gseidel
 * Date: 11.05.18
 * Time: 12:31
 */

namespace App\Command;

use App\Logger\OutputHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

abstract class AbstractCommand extends Command
{
    use ContainerAwareTrait;

    /**
     * @var Logger
     */
    private $logger;

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

    public function pushOutputHandler(OutputInterface $output)
    {
        $handler = new OutputHandler();
        $handler->setOutput($output);
        $this->logger->pushHandler($handler);
    }

    public function popHandler()
    {
        $this->logger->popHandler();
    }
}

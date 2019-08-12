<?php
/**
 * Created by PhpStorm.
 * User: gseidel
 * Date: 11.05.18
 * Time: 12:31
 */

namespace App\Command;

use App\Logger\OutputHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

abstract class AbstractCommand extends Command
{
    use ContainerAwareTrait;

    public function pushOutputHandler(OutputInterface $output)
    {
        $handler = new OutputHandler();
        $handler->setOutput($output);
        $this->container->get('logger')->pushHandler($handler);
    }

    public function popHandler()
    {
        $this->container->get('logger')->popHandler();
    }
}

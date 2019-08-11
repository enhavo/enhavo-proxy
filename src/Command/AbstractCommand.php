<?php
/**
 * Created by PhpStorm.
 * User: gseidel
 * Date: 11.05.18
 * Time: 12:31
 */

namespace App\Command;

use App\Logger\OutputHandler;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractCommand extends ContainerAwareCommand
{
    public function pushOutputHandler(OutputInterface $output)
    {
        $handler = new OutputHandler();
        $handler->setOutput($output);
        $this->getContainer()->get('logger')->pushHandler($handler);
    }

    public function popHandler()
    {
        $this->getContainer()->get('logger')->popHandler();
    }
}
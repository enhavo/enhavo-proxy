<?php
/**
 * Created by PhpStorm.
 * User: m
 * Date: 17.03.17
 * Time: 12:26
 */

namespace App\Command;

use App\Manager\NginxManager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class NginxRestartCommand extends AbstractCommand
{
    use ContainerAwareTrait;

    protected function configure()
    {
        $this
            ->setName('proxy:nginx:restart')
            ->setDescription('reload nginx config');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->pushOutputHandler($output);
        $this->container->get(NginxManager::class)->reload();
        $this->popHandler();
    }
}

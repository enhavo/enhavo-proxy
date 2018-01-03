<?php
/**
 * Created by PhpStorm.
 * User: m
 * Date: 17.03.17
 * Time: 12:26
 */

namespace ProjectBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class NginxCompileCommand extends ContainerAwareCommand
{
    use ContainerAwareTrait;

    protected function configure()
    {
        $this
            ->setName('proxy:nginx:compile')
            ->setDescription('compile nginx config');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $hosts = $this->getContainer()->get('project.repository.host')->findAll();
        $this->getContainer()->get('project.nginx.compiler')->compile($hosts);
        $output->writeln('nginx file saved');
    }
}
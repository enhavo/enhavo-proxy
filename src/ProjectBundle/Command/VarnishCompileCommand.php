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

class VarnishCompileCommand extends ContainerAwareCommand
{
    use ContainerAwareTrait;

    protected function configure()
    {
        $this
            ->setName('proxy:varnish:compile')
            ->setDescription('compile varnish config');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $hosts = $this->getContainer()->get('project.repository.host')->findAll();
        $this->getContainer()->get('project.varnish.compiler')->compile($hosts);
    }
}
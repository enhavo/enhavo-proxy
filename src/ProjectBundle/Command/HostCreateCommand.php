<?php
/**
 * Created by PhpStorm.
 * User: m
 * Date: 17.03.17
 * Time: 12:26
 */

namespace ProjectBundle\Command;

use Matthias\SymfonyConsoleForm\Console\Helper\FormHelper;
use ProjectBundle\Entity\Host;
use ProjectBundle\Form\Type\ConsoleHostType;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class HostCreateCommand extends ContainerAwareCommand
{
    use ContainerAwareTrait;

    protected function configure()
    {
        $this
            ->setName('host:create')
            ->setDescription('create host');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $formHelper = $this->getHelper('form');
        /** @var FormHelper $formHelper */
        $host = new Host();
        $formHelper->interactUsingForm(new ConsoleHostType(), $input, $output, [], $host);
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $em->persist($host);
        $em->flush();
    }
}
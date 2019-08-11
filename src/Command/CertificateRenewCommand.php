<?php
/**
 * Created by PhpStorm.
 * User: m
 * Date: 17.03.17
 * Time: 12:26
 */

namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class CertificateRenewCommand extends AbstractCommand
{
    use ContainerAwareTrait;

    protected function configure()
    {
        $this
            ->setName('proxy:certificate:renew')
            ->addArgument('domain', InputArgument::OPTIONAL, 'specify domain')
            ->setDescription('renew certificates');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->pushOutputHandler($output);
        $certificateManager = $this->getContainer()->get('manager.certificate');
        $hostManager = $this->getContainer()->get('manager.host');
        $domain = $input->getArgument('domain');
        if($domain) {
            $host = $hostManager->getHostByDomain($domain);
            if($host === null) {
                $output->writeln('cant find host');
            }
            $certificateManager->renewCertificate($host);
        } else {
            $certificateManager->renewCertificates();
        }
        $output->writeln('certificates renewed');
        $this->popHandler();
    }
}
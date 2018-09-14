<?php
/**
 * Created by PhpStorm.
 * User: m
 * Date: 17.03.17
 * Time: 12:26
 */

namespace ProjectBundle\Command;

use ProjectBundle\Entity\Host;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class CertificateCronJobCommand extends AbstractCommand
{
    use ContainerAwareTrait;

    protected function configure()
    {
        $this
            ->setName('proxy:certificate:cron-job')
            ->setDescription('job for cron to update certificates automatically');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->pushOutputHandler($output);
        $certificateManager = $this->getContainer()->get('manager.certificate');
        $certificateFactory = $this->getContainer()->get('certificate.factory');
        $nginxManager = $this->getContainer()->get('manager.nginx');

        /** @var Host $host */
        $hosts = $this->getContainer()->get('project.repository.host')->findBy([
            'certifcateType' => Host::CERTIFICATE_TYPE_LETS_ENCRYPT
        ]);

        $hostsToRenew = [];

        foreach($hosts as $host) {
            $certificate = $certificateFactory->createFromString($host->getCertificate());
            if($certificate === null) {
                $hostsToRenew[] = $host;
            } elseif($host->getCertificateRefresh() != Host::REFRESH_NONE) {
                $checkDate = new \DateTime(sprintf('-%s days', $host->getCertificateRefresh()));
                if($checkDate > $certificate->getValidTo()) {
                    $hostsToRenew[] = $host;
                }
            }
        }

        foreach($hostsToRenew as $host) {
            $certificateManager->renewCertificate($host);
        }

        $nginxManager->reload();

        $this->popHandler();
    }
}
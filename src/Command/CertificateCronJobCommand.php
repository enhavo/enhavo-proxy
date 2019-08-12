<?php
/**
 * Created by PhpStorm.
 * User: m
 * Date: 17.03.17
 * Time: 12:26
 */

namespace App\Command;

use App\Certificate\CertificateFactory;
use App\Entity\Host;
use App\Manager\CertificateManager;
use App\Manager\NginxManager;
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
        $certificateManager = $this->container->get(CertificateManager::class);
        $certificateFactory = $this->container->get(CertificateFactory::class);
        $nginxManager = $this->container->get(NginxManager::class);

        /** @var Host $host */
        $hosts = $this->container->get('app.repository.host')->findBy([
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

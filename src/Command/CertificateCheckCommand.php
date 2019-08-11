<?php
/**
 * Created by PhpStorm.
 * User: m
 * Date: 17.03.17
 * Time: 12:26
 */

namespace App\Command;

use App\Entity\Host;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class CertificateCheckCommand extends AbstractCommand
{
    use ContainerAwareTrait;

    protected function configure()
    {
        $this
            ->setName('proxy:certificate:check')
            ->addArgument('host', InputArgument::REQUIRED, 'host to check')
            ->setDescription('check certificate');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $host = $input->getArgument('host');
        $this->pushOutputHandler($output);

        /** @var Host $host */
        $host = $this->getContainer()->get('project.repository.host')->findOneBy([
            'domain' => $host
        ]);

        if(empty($host)) {
            $output->writeln('<error>Can\'t find host</error>');
            return;
        }

        $certificate = $this->getContainer()->get('certificate.factory')->createFromString($host->getCertificate());

        $output->writeln(sprintf('Valid From: %s', $certificate->getValidFrom()->format('Y-m-d H:i:s')));
        $output->writeln(sprintf('Valid Until: %s', $certificate->getValidTo()->format('Y-m-d H:i:s')));
        $output->writeln(sprintf('Common name: %s', $certificate->getCommonName()));
        $output->writeln(sprintf('Name: %s', $certificate->getName()));
        $output->writeln(sprintf('Hash: %s', $certificate->getHash()));
        $output->writeln(sprintf('Issuer Common Name: %s', $certificate->getIssuerCommonName()));
        $output->writeln(sprintf('Issuer Country Name: %s', $certificate->getIssuerCountryName()));
        $output->writeln(sprintf('Issuer Organization Name: %s', $certificate->getIssuerOrganizationName()));
        $output->writeln(sprintf('Signature Type LN: %s', $certificate->getSignatureTypeLN()));
        $output->writeln(sprintf('Signature Type SN: %s', $certificate->getSignatureTypeSN()));

        $this->popHandler();
    }
}
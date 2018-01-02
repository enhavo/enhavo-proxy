<?php
/**
 * Created by PhpStorm.
 * User: gseidel
 * Date: 02.01.18
 * Time: 14:21
 */

namespace ProjectBundle\Certificate;


use ProjectBundle\Entity\Host;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Filesystem\Filesystem;

class CertificateManager
{
    use ContainerAwareTrait;

    public function dumpCertificates()
    {
        $fs = new Filesystem();
        /** @var Host[] $hosts */
        $hosts = $this->container->get('project.repository.host')->findAll();
        foreach($hosts as $host) {
            if($host->getCertificate()) {
                $fs->dumpFile($this->getCertificatePath($host), $host->getCertificate());
                $fs->dumpFile($this->getCertificateKeyPath($host), $host->getCertificateKey());
            }
        }
    }

    public function getCertificatePath(Host $host)
    {
        $path = sprintf('%s/%s.crt', $this->container->getParameter('certificate_path'), $host->getDomain());
        return $path;
    }

    public function getCertificateKeyPath(Host $host)
    {
        $path = sprintf('%s/%s.key', $this->container->getParameter('certificate_path'), $host->getDomain());
        return $path;
    }
}
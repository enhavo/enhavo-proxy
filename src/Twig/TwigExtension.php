<?php
/**
 * TwigFunction.php
 */

namespace App\Twig;

use App\Entity\Host;
use App\Manager\CertificateManager;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Twig\Extension\AbstractExtension;

class TwigExtension extends AbstractExtension
{
    use ContainerAwareTrait;

    public function getFunctions()
    {
        return [];
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('ssl_certificate_path', array($this, 'getSSLCertificatePath')),
            new \Twig_SimpleFilter('ssl_certificate_key_path', array($this, 'getSSLCertificateKeyPath'))
        ];
    }

    public function getSSLCertificatePath(Host $host)
    {
        return $this->container->get(CertificateManager::class)->getCertificatePath($host);
    }

    public function getSSLCertificateKeyPath(Host $host)
    {
        return $this->container->get(CertificateManager::class)->getCertificateKeyPath($host);
    }
}

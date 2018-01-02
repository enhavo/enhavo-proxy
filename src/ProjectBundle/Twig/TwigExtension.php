<?php
/**
 * TwigFunction.php
 */

namespace ProjectBundle\Twig;

use ProjectBundle\Entity\Host;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class TwigExtension extends \Twig_Extension
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
        return $this->container->get('project.certificate.manager')->getCertificatePath($host);
    }

    public function getSSLCertificateKeyPath(Host $host)
    {
        return $this->container->get('project.certificate.manager')->getCertificateKeyPath($host);
    }

    public function getName()
    {
        return 'twig_extension';
    }
}
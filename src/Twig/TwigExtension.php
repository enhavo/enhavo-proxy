<?php
/**
 * TwigFunction.php
 */

namespace App\Twig;

use App\Entity\Host;
use App\Entity\Rule;
use App\Manager\CertificateManager;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    use ContainerAwareTrait;

    public function getFunctions()
    {
        return [
            new TwigFunction('render_varnish_rule', array($this, 'renderVarnishRule'), [
                'is_safe' => array('html')
            ]),
        ];
    }

    public function getFilters()
    {
        return [
            new TwigFilter('ssl_certificate_path', array($this, 'getSSLCertificatePath')),
            new TwigFilter('ssl_certificate_key_path', array($this, 'getSSLCertificateKeyPath'))
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

    public function renderVarnishRule(Rule $rule)
    {
        $template = sprintf('Varnish/rule/%s.html.twig', $rule->getType());
        return $this->container->get('twig')->render($template, [
            'rule' => $rule
        ]);
    }
}

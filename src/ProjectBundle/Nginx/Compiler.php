<?php
/**
 * Compiler.php
 *
 * @since 07/04/17
 * @author gseidel
 */

namespace ProjectBundle\Nginx;

use ProjectBundle\Entity\Host;
use Symfony\Component\Templating\EngineInterface;

class Compiler
{
    /**
     * @var EngineInterface
     */
    private $templateEngine;

    public function __construct(EngineInterface $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    /**
     * @param Host[] $hosts
     * @return string
     */
    public function compile($hosts)
    {
        return $this->templateEngine->render('ProjectBundle:Nginx:nginx.conf.twig', [
            'hosts' => $hosts
        ]);
    }
}
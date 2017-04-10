<?php
/**
 * Compiler.php
 *
 * @since 07/04/17
 * @author gseidel
 */

namespace ProjectBundle\Nginx;

use Enhavo\Bundle\AppBundle\Filesystem\Filesystem;
use ProjectBundle\Entity\Host;
use Symfony\Component\Templating\EngineInterface;

class Compiler
{
    /**
     * @var EngineInterface
     */
    private $templateEngine;

    /**
     * @var Filesystem
     */
    private $fs;

    /**
     * @var string
     */
    private $configPath;

    public function __construct(EngineInterface $templateEngine, Filesystem $fs, $configPath)
    {
        $this->templateEngine = $templateEngine;
        $this->fs = $fs;
        $this->configPath = $configPath;
    }

    /**
     * @param Host[] $hosts
     * @return string
     */
    public function compile($hosts)
    {
        $content = $this->templateEngine->render('ProjectBundle:Nginx:nginx.conf.twig', [
            'hosts' => $hosts
        ]);

        $this->fs->dumpFile($this->configPath, $content);
    }
}
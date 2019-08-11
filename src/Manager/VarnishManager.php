<?php
/**
 * VarnishManager.php
 *
 * @since 07/04/17
 * @author gseidel
 */

namespace ProjectBundle\Manager;

use ProjectBundle\Entity\Host;

class VarnishManager extends AbstractManager
{
    /**
     * @param Host[] $hosts
     * @return string
     */
    public function compileHosts($hosts)
    {
        $this->getLogger()->info('compile varnish file');

        $content = $this->render('ProjectBundle:Varnish:default.vcl.twig', [
            'hosts' => $hosts
        ]);

        $configFilePath = $this->getConfigFilePath();
        $this->getFilesystem()->dumpFile($configFilePath, $content);

        $this->getLogger()->info(sprintf('config file saved to "%s"', $configFilePath));

        return $content;
    }

    /**
     * @return string
     */
    public function compile()
    {
        $hosts = $this->container->get('project.repository.host')->findAll();
        $content = $this->compileHosts($hosts);
        return $content;
    }

    public function reload()
    {
        $this->getLogger()->info('reload varnish');
        $time = (new \DateTime())->format('YmdHi');
        $this->getLogger()->info('load file /etc/varnish/default.vcl');
        $this->executeCommand(sprintf('varnishadm -S /etc/varnish/secret -T 127.0.0.1:6082 vcl.load varnish_%s /etc/varnish/default.vcl', $time));
        $this->getLogger()->info('use vanish file');
        $this->executeCommand(sprintf('varnishadm -S /etc/varnish/secret -T 127.0.0.1:6082 vcl.use varnish_%s', $time));
    }

    public function testConfig()
    {
        $this->getLogger()->info('compile check for varnish');
        $this->executeCommand('varnishd -C -f /etc/varnish/default.vcl');
    }

    public function createSecretFile()
    {
        $this->getFilesystem()->dumpFile($this->getSecretFilePath(), uniqid());
    }

    public function getSecretFilePath()
    {
        return $this->container->getParameter('varnish_secret');
    }

    public function getConfigFilePath()
    {
        return $this->container->getParameter('varnish_config');
    }
}
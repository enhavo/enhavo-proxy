<?php
/**
 * VarnishManager.php
 *
 * @since 07/04/17
 * @author gseidel
 */

namespace App\Manager;

use App\Entity\Host;

class VarnishManager extends AbstractManager
{
    /**
     * @param Host[] $hosts
     * @return string
     */
    public function compileHosts($hosts)
    {
        $this->getLogger()->info('compile varnish file');

        $content = $this->render('Varnish/default.vcl.twig', [
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
        $hosts = $this->container->get('app.repository.host')->findAll();
        $content = $this->compileHosts($hosts);
        return $content;
    }

    public function reload()
    {
        $this->getLogger()->info('reload varnish');
        $this->getLogger()->info('load file /etc/varnish/default.vcl');
        $configName = sprintf('varnish_%s', (new \DateTime())->format('YmdHi'));
        $this->executeCommand(['varnishadm', '-S', '/etc/varnish/secret', '-T', '127.0.0.1:6082', 'vcl.load', $configName, '/etc/varnish/default.vcl']);
        $this->getLogger()->info('use vanish file');
        $this->executeCommand(['varnishadm', '-S', '/etc/varnish/secret', '-T', '127.0.0.1:6082', 'vcl.use', $configName]);
    }

    public function testConfig()
    {
        $this->getLogger()->info('compile check for varnish');
        $this->executeCommand(['varnishd', '-C', '-f', '/etc/varnish/default.vcl']);
    }

    public function createSecretFile()
    {
        $this->getFilesystem()->dumpFile($this->getSecretFilePath(), sha1(random_bytes(32)));
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

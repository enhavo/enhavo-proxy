<?php
/**
 * NginxManager.php
 *
 * @since 07/04/17
 * @author gseidel
 */

namespace ProjectBundle\Nginx;

use ProjectBundle\Entity\Host;
use ProjectBundle\Manager\AbstractManager;

class NginxManager extends AbstractManager
{
    /**
     * @param Host[] $hosts
     * @return string
     */
    public function compile($hosts)
    {
        $this->getLogger()->info('compile nginx file');

        $content = $this->render('ProjectBundle:Nginx:nginx.conf.twig', [
            'hosts' => $hosts
        ]);

        $configPath = $this->getConfigPath();
        $this->getFilesystem()->dumpFile($configPath, $content);

        $this->getLogger()->info(sprintf('config file saved to "%s"', $configPath));

        return $content;
    }

    public function reload()
    {
        $this->executeCommand('sudo service nginx reload');
    }

    private function getConfigPath()
    {
        $this->container->getParameter('nginx_config');
    }
}
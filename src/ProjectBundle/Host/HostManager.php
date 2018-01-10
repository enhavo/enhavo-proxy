<?php
/**
 * HostManager.php
 *
 * @since 08/04/17
 * @author gseidel
 */

namespace ProjectBundle\Host;


use Enhavo\Bundle\AppBundle\Slugifier\Slugifier;
use ProjectBundle\Entity\Backend;
use ProjectBundle\Entity\Host;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class HostManager
{
    use ContainerAwareTrait;

    public function updateHost(Host $host)
    {
        /** @var Backend $backend */
        $domainSlug = Slugifier::slugify($host->getDomain(), '_');

        $host->setDirectorName($domainSlug);

        $i = 0;
        foreach($host->getBackends() as $backend) {
            $backend->setName(sprintf('%s_%s', $domainSlug, $i));
            $i++;

            if($backend->getBetweenBytesTimeout() === null) {
                $backend->setBetweenBytesTimeout(900);
            }

            if($backend->getFirstByteTimeout() === null) {
                $backend->setFirstByteTimeout(900);
            }

            if($backend->getConnectTimeout() === null) {
                $backend->setConnectTimeout(900);
            }
        }
    }

    /**
     * @param $domain
     * @return null|Host
     */
    public function getHostByDomain($domain)
    {
        $repository = $this->container->get('doctrine.orm.entity_manager')->getRepository(Host::class);
        return $repository->findOneBy([
            'domain' => $domain
        ]);
    }
}
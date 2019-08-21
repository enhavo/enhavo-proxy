<?php
/**
 * HostManager.php
 *
 * @since 08/04/17
 * @author gseidel
 */

namespace App\Manager;

use Gedmo\Sluggable\Util\Urlizer;
use App\Entity\Backend;
use App\Entity\Host;

class HostManager extends AbstractManager
{
    public function updateHost(Host $host)
    {
        /** @var Backend $backend */
        $domainSlug = $this->slugify($host->getDomain(), '_');

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

    private function slugify($content, $separator = '-')
    {
        $urlizer = new Urlizer();
        $content = $urlizer->urlize($content, $separator);
        $content  = $urlizer->transliterate($content, $separator);
        return $content;
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

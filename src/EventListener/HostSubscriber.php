<?php
/**
 * SaveListener.php
 *
 * @since 08/04/17
 * @author gseidel
 */

namespace App\EventListener;

use App\Certificate\CertificateFactory;
use App\Entity\Host;
use App\Manager\HostManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class HostSubscriber  implements EventSubscriberInterface
{
    /**
     * @var HostManager
     */
    private $hostManager;

    /**
     * @var CertificateFactory
     */
    private $certificateFactory;

    /**
     * HostSubscriber constructor.
     * @param HostManager $hostManager
     * @param CertificateFactory $certificateFactory
     */
    public function __construct(HostManager $hostManager, CertificateFactory $certificateFactory)
    {
        $this->hostManager = $hostManager;
        $this->certificateFactory = $certificateFactory;
    }

    public static function getSubscribedEvents()
    {
        return array(
            'app.host.pre_update' => array('onSave', 1),
            'app.host.pre_create' => array('onSave', 1),
        );
    }

    public function onSave(GenericEvent $event)
    {
        $subject = $event->getSubject();
        if($subject instanceof Host) {
            $this->hostManager->updateHost($subject);

            if ($subject->getCertificate()) {
                $cert = $this->certificateFactory->createFromString($subject->getCertificate());
                if ($cert && $cert->getValidTo()) {
                    $subject->setCertificateValidTo($cert->getValidTo());
                }
            }
        }
    }
}

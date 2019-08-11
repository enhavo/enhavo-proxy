<?php
/**
 * SaveListener.php
 *
 * @since 08/04/17
 * @author gseidel
 */

namespace App\EventListener;

use App\Entity\Host;
use App\Host\HostManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class HostSubscriber  implements EventSubscriberInterface
{
    /**
     * @var HostManager
     */
    private $hostManager;

    /**
     * HostSubscriber constructor.
     * @param $hostManager
     */
    public function __construct($hostManager)
    {
        $this->hostManager = $hostManager;
    }

    public static function getSubscribedEvents()
    {
        return array(
            'project.host.pre_update' => array('onSave', 1),
            'project.host.pre_create' => array('onSave', 1),
        );
    }

    public function onSave(GenericEvent $event)
    {
        $subject = $event->getSubject();
        if($subject instanceof Host) {
            $this->hostManager->updateHost($subject);
        }
    }
}
<?php
/**
 * Host.php
 *
 * @since 19/03/17
 * @author gseidel
 */

namespace ProjectBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Component\Resource\Model\ResourceInterface;

class Host implements ResourceInterface
{
    const HTTPS_OFF = 0;
    const HTTPS_ON = 1;
    const HTTPS_ONLY = 2;

    const TRANSFER_TYPE_PIPE = 'pipe';
    const TRANSFER_TYPE_PASS = 'pass';

    const BACKEND_STRATEGY_FALLBACK = 'fallback';
    const BACKEND_STRATEGY_ROUND_ROBIN = 'round_robin';


    /**
     * @var int
     */
    private $id;

    /**
     * @var
     */
    private $domain;

    /**
     * @var int
     */
    private $https;

    /**
     * @var ArrayCollection
     */
    private $backends;

    /**
     * @var string
     */
    private $transferType;

    /**
     * @var string
     */
    private $backendStrategy;

    /**
     * @var string
     */
    private $certPath;

    /**
     * @var string
     */
    private $keyPath;

    /**
     * @var string
     */
    private $directorName;

    /**
     * @var string
     */
    private $redirect;

    public function __construct()
    {
        $this->backends = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param mixed $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return int
     */
    public function getHttps()
    {
        return $this->https;
    }

    /**
     * @param int $https
     */
    public function setHttps($https)
    {
        $this->https = $https;
    }

    /**
     * @return string
     */
    public function getTransferType()
    {
        return $this->transferType;
    }

    /**
     * @param string $transferType
     */
    public function setTransferType($transferType)
    {
        $this->transferType = $transferType;
    }

    /**
     * @return string
     */
    public function getBackendStrategy()
    {
        return $this->backendStrategy;
    }

    /**
     * @param string $backendStrategy
     */
    public function setBackendStrategy($backendStrategy)
    {
        $this->backendStrategy = $backendStrategy;
    }

    /**
     * @return string
     */
    public function getDirectorName()
    {
        return $this->directorName;
    }

    /**
     * @param string $directorName
     */
    public function setDirectorName($directorName)
    {
        $this->directorName = $directorName;
    }

    /**
     * Add backends
     *
     * @param \ProjectBundle\Entity\Backend $backends
     * @return Host
     */
    public function addBackend(\ProjectBundle\Entity\Backend $backends)
    {
        $backends->setHost($this);
        $this->backends[] = $backends;

        return $this;
    }

    /**
     * Remove backends
     *
     * @param \ProjectBundle\Entity\Backend $backends
     */
    public function removeBackend(\ProjectBundle\Entity\Backend $backends)
    {
        $backends->setHost(null);
        $this->backends->removeElement($backends);
    }

    /**
     * Get backends
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBackends()
    {
        return $this->backends;
    }

    public function __toString()
    {
        return (string)$this->getDomain();
    }

    /**
     * @return string
     */
    public function getCertPath()
    {
        return $this->certPath;
    }

    /**
     * @param string $certPath
     */
    public function setCertPath($certPath)
    {
        $this->certPath = $certPath;
    }

    /**
     * @return mixed
     */
    public function getKeyPath()
    {
        return $this->keyPath;
    }

    /**
     * @param mixed $keyPath
     */
    public function setKeyPath($keyPath)
    {
        $this->keyPath = $keyPath;
    }

    /**
     * @return string
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * @param string $redirect
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }
}

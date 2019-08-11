<?php
/**
 * Backend.php
 *
 * @since 19/03/17
 * @author gseidel
 */

namespace App\Entity;


use Sylius\Component\Resource\Model\ResourceInterface;

class Backend implements ResourceInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $hostname;

    /**
     * @var integer
     */
    private $port;

    /**
     * @var integer
     */
    private $connectTimeout;

    /**
     * @var integer
     */
    private $firstByteTimeout;

    /**
     * @var integer
     */
    private $betweenBytesTimeout;

    /**
     * @var string
     */
    private $ipv4;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return int
     */
    public function getConnectTimeout()
    {
        return $this->connectTimeout;
    }

    /**
     * @param int $connectTimeout
     */
    public function setConnectTimeout($connectTimeout)
    {
        $this->connectTimeout = $connectTimeout;
    }

    /**
     * @return int
     */
    public function getFirstByteTimeout()
    {
        return $this->firstByteTimeout;
    }

    /**
     * @param int $firstByteTimeout
     */
    public function setFirstByteTimeout($firstByteTimeout)
    {
        $this->firstByteTimeout = $firstByteTimeout;
    }

    /**
     * @return int
     */
    public function getBetweenBytesTimeout()
    {
        return $this->betweenBytesTimeout;
    }

    /**
     * @param int $betweenBytesTimeout
     */
    public function setBetweenBytesTimeout($betweenBytesTimeout)
    {
        $this->betweenBytesTimeout = $betweenBytesTimeout;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function __toString()
    {
        return (string)$this->getName();
    }

    /**
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * @param string $hostname
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
    }
}

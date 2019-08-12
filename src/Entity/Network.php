<?php

namespace App\Entity;


use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Class Network
 * @package App\Entity
 */
class Network implements ResourceInterface
{
    /**
     * @var integer
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}

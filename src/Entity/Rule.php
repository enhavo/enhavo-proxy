<?php
/**
 * Created by PhpStorm.
 * User: gseidel
 * Date: 2019-10-02
 * Time: 17:22
 */

namespace App\Entity;


class Rule
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var
     */
    private $type;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $password;

    /**
     * @var
     */
    private $path;

    /**
     * @var string|null
     */
    private $transferType;

    /**
     * @var Host
     */
    private $host;

    /**
     * @var int
     */
    private $position;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getUser(): ?string
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser(?string $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

    /**
     * @return string|null
     */
    public function getTransferType(): ?string
    {
        return $this->transferType;
    }

    /**
     * @param string|null $transferType
     */
    public function setTransferType(?string $transferType): void
    {
        $this->transferType = $transferType;
    }

    /**
     * @return Host
     */
    public function getHost(): ?Host
    {
        return $this->host;
    }

    /**
     * @param Host $host
     */
    public function setHost(?Host $host): void
    {
        $this->host = $host;
    }

    /**
     * @return string|null
     */
    public function getAuthenticationUser()
    {
        if($this->user && $this->password) {
            return base64_encode(sprintf('%s:%s', $this->user, $this->password));
        }
        return null;
    }

    /**
     * @return int|null
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @param int|null $position
     * @return $this
     */
    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }


}

<?php
/**
 * Created by PhpStorm.
 * User: gseidel
 * Date: 14.09.18
 * Time: 01:54
 */

namespace ProjectBundle\Certificate;


use Symfony\Component\Validator\Constraints\DateTime;

class Certificate
{
    /**
     * @var \DateTime
     */
    private $validFrom;

    /**
     * @var \DateTime
     */
    private $validTo;

    /**
     * @var string
     */
    private $commonName;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $issuerCountryName;

    /**
     * @var string
     */
    private $issuerOrganizationName;

    /**
     * @var string
     */
    private $issuerCommonName;

    /**
     * @var string
     */
    private $hash;

    /**
     * @var string
     */
    private $signatureTypeSN;

    /**
     * @var string
     */
    private $signatureTypeLN;

    /**
     * @return \DateTime
     */
    public function getValidFrom()
    {
        return $this->validFrom;
    }

    /**
     * @param \DateTime $validFrom
     */
    public function setValidFrom($validFrom)
    {
        $this->validFrom = $validFrom;
    }

    /**
     * @return \DateTime
     */
    public function getValidTo()
    {
        return $this->validTo;
    }

    /**
     * @param \DateTime $validTo
     */
    public function setValidTo($validTo)
    {
        $this->validTo = $validTo;
    }

    /**
     * @return string
     */
    public function getCommonName()
    {
        return $this->commonName;
    }

    /**
     * @param string $commonName
     */
    public function setCommonName($commonName)
    {
        $this->commonName = $commonName;
    }

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
    public function getIssuerCountryName()
    {
        return $this->issuerCountryName;
    }

    /**
     * @param string $issuerCountryName
     */
    public function setIssuerCountryName($issuerCountryName)
    {
        $this->issuerCountryName = $issuerCountryName;
    }

    /**
     * @return string
     */
    public function getIssuerOrganizationName()
    {
        return $this->issuerOrganizationName;
    }

    /**
     * @param string $issuerOrganizationName
     */
    public function setIssuerOrganizationName($issuerOrganizationName)
    {
        $this->issuerOrganizationName = $issuerOrganizationName;
    }

    /**
     * @return string
     */
    public function getIssuerCommonName()
    {
        return $this->issuerCommonName;
    }

    /**
     * @param string $issuerCommonName
     */
    public function setIssuerCommonName($issuerCommonName)
    {
        $this->issuerCommonName = $issuerCommonName;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getSignatureTypeSN()
    {
        return $this->signatureTypeSN;
    }

    /**
     * @param string $signatureTypeSN
     */
    public function setSignatureTypeSN($signatureTypeSN)
    {
        $this->signatureTypeSN = $signatureTypeSN;
    }

    /**
     * @return string
     */
    public function getSignatureTypeLN()
    {
        return $this->signatureTypeLN;
    }

    /**
     * @param string $signatureTypeLN
     */
    public function setSignatureTypeLN($signatureTypeLN)
    {
        $this->signatureTypeLN = $signatureTypeLN;
    }
}
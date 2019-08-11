<?php
/**
 * Created by PhpStorm.
 * User: gseidel
 * Date: 14.09.18
 * Time: 01:55
 */

namespace App\Certificate;


class CertificateFactory
{
    public function createFromString($string)
    {
        $certificate = new Certificate();
        $data = openssl_x509_parse($string, false);

        if($data === false) {
            return null;
        }

        $certificate->setName($data['name']);
        $certificate->setCommonName($data['subject']['commonName']);
        $certificate->setValidFrom((new \DateTime())->setTimestamp($data['validFrom_time_t']));
        $certificate->setValidTo((new \DateTime())->setTimestamp($data['validTo_time_t']));
        $certificate->setHash($data['hash']);
        $certificate->setIssuerCommonName($data['issuer']['commonName']);
        $certificate->setIssuerCountryName($data['issuer']['countryName']);
        $certificate->setIssuerOrganizationName($data['issuer']['organizationName']);
        $certificate->setSignatureTypeLN($data['signatureTypeLN']);
        $certificate->setSignatureTypeSN($data['signatureTypeSN']);

        return $certificate;
    }
}
<?php

namespace App\Certificate;

class Lescript extends \Analogic\ACME\Lescript
{
    public $ca = 'https://acme-v01.api.letsencrypt.org';
    public $license = 'https://letsencrypt.org/documents/LE-SA-v1.1.1-August-1-2016.pdf';
    public $countryCode = 'DE';
    public $state = "Germany";
    public $challenge = 'http-01';
    public $contact = array();
}

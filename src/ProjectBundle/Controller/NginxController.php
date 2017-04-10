<?php
/**
 * LetsEncrypt.php
 *
 * @since 10/04/17
 * @author gseidel
 */

namespace ProjectBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NginxController
{
    public function wellKnownAction(Request $request)
    {
        $token = $request->get('token');
        return new Response($token);
    }
}
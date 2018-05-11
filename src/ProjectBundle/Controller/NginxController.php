<?php
/**
 * LetsEncrypt.php
 *
 * @since 10/04/17
 * @author gseidel
 */

namespace ProjectBundle\Controller;

use ProjectBundle\Manager\NginxManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NginxController extends AbstractController
{
    public function wellKnownAction(Request $request)
    {
        $token = $request->get('token');
        $content = $this->container->get('manager.certificate')->getToken($token);
        if($content === null) {
            throw $this->createNotFoundException();
        }
        return new Response($content);
    }

    public function restartAction()
    {
        $controller = $this;
        return new StreamedResponse(function() use ($controller) {
            $controller->pushEchoHandler();
            $controller->getManager()->reload();
            $controller->popHandler();
        });
    }

    public function compileAction()
    {
        $controller = $this;
        return new StreamedResponse(function() use ($controller) {
            $controller->pushEchoHandler();
            $controller->getManager()->compile();
            $controller->popHandler();
        });
    }

    /**
     * @return NginxManager
     */
    private function getManager()
    {
        return $this->container->get('manager.nginx');
    }
}
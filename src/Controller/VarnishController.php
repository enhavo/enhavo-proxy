<?php

namespace App\Controller;

use App\Manager\VarnishManager;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VarnishController extends AbstractController
{
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
     * @return VarnishManager
     */
    private function getManager()
    {
        return $this->container->get('manager.varnish');
    }
}
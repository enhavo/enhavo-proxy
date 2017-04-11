<?php
/**
 * LetsEncrypt.php
 *
 * @since 10/04/17
 * @author gseidel
 */

namespace ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class NginxController extends Controller
{
    public function wellKnownAction(Request $request)
    {
        $token = $request->get('token');
        return new Response($token);
    }

    public function restartNginxAction()
    {
        $output = $this->container->get('project.nginx.manger')->restart();
        return new JsonResponse($output);
    }

    public function compileConfigAction()
    {
        $hosts = $this->get('project.repository.host')->findAll();
        $this->container->get('project.nginx.compiler')->compile($hosts);
        return new JsonResponse('compiled');
    }
}
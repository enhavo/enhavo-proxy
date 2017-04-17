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
        if(is_array($output)) {
            $output = implode("\n", $output);
        }
        $output = htmlentities($output);
        return new Response($output);
    }

    public function compileConfigAction()
    {
        $output = $this->container->get('project.nginx.manger')->compile();
        if(is_array($output)) {
            $output = implode("\n", $output);
        }
        $output = htmlentities($output);
        return new Response($output);
    }
}
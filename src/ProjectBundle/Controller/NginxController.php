<?php
/**
 * LetsEncrypt.php
 *
 * @since 10/04/17
 * @author gseidel
 */

namespace ProjectBundle\Controller;

use ProjectBundle\Entity\Host;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NginxController extends Controller
{
    public function wellKnownAction(Request $request)
    {
        $token = $request->get('token');
        $token = $this->getDoctrine()->getRepository('ProjectBundle:Token')->findOneBy([
            'token' => $token
        ]);

        if($token === null) {
            throw $this->createNotFoundException();
        }

        return new Response($token->getContent());
    }

    public function signAction(Request $request)
    {
        $manager = $this->get('project.certificate.manager');
        $manager->initAccount();

        $hostArray = [];
        $hosts = $this->get('project.repository.host')->findAll();
        /** @var Host $host */
        foreach($hosts as $host) {
            $hostArray[] = $host->getDomain();
        }
        $manager->signDomains($hostArray);
        return new Response('');
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
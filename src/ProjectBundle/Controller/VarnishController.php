<?php

namespace ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class VarnishController extends Controller
{
    public function showConfigAction()
    {
        $hosts = $this->get('project.repository.host')->findAll();
        $content = $this->get('project.varnish.compiler')->compile($hosts);
        return new Response($content);
    }
    
    public function restartVarnishAction()
    {
        $output = $this->container->get('project.varnish.manger')->restart();
        return new JsonResponse($output);
    }

    public function compileConfigAction()
    {
        $hosts = $this->get('project.repository.host')->findAll();
        $this->container->get('project.varnish.compiler')->compile($hosts);
        return new JsonResponse('compiled');
    }
}
<?php

namespace ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        if(is_array($output)) {
            $output = implode("\n", $output);
        }
        $output = htmlentities($output);
        return new Response($output);
    }

    public function compileConfigAction()
    {
        $output = $this->container->get('project.varnish.manger')->compile();
        if(is_array($output)) {
            $output = implode("\n", $output);
        }
        $output = htmlentities($output);
        return new Response($output);
    }
}
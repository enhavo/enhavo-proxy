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
}
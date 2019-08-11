<?php
/**
 * Created by PhpStorm.
 * User: gseidel
 * Date: 11.05.18
 * Time: 11:48
 */

namespace App\Controller;
use App\Logger\EchoHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class AbstractController extends Controller
{
    public function pushEchoHandler()
    {
        $this->container->get('logger')->pushHandler(new EchoHandler());
    }

    public function popHandler()
    {
        $this->container->get('logger')->popHandler();
    }
}
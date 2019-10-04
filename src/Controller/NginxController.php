<?php
/**
 * LetsEncrypt.php
 *
 * @since 10/04/17
 * @author gseidel
 */

namespace App\Controller;

use App\Manager\CertificateManager;
use Enhavo\Bundle\AppBundle\Controller\AbstractViewController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Enhavo\Bundle\AppBundle\Output\EchoStreamOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

class NginxController extends AbstractViewController
{
    public function indexAction()
    {
        $view = $this->viewFactory->create('nginx', [

        ]);

        return $this->viewHandler->handle($view);
    }

    public function wellKnownAction(Request $request)
    {
        $token = $request->get('token');
        $content = $this->container->get(CertificateManager::class)->getToken($token);
        if($content === null) {
            throw $this->createNotFoundException();
        }
        return new Response($content);
    }

    public function restartAction()
    {
        $application = new Application($this->container->get('kernel'));
        $application->setAutoExit(false);

        return new StreamedResponse(function() use ($application) {

            $input = new ArrayInput([
                'command' => 'proxy:nginx:restart',
            ]);

            $output = new EchoStreamOutput(fopen('php://stdout', 'w'), OutputInterface::VERBOSITY_NORMAL, true);
            $application->run($input, $output);
        });
    }

    public function compileAction()
    {
        $application = new Application($this->container->get('kernel'));
        $application->setAutoExit(false);

        return new StreamedResponse(function() use ($application) {

            $input = new ArrayInput([
                'command' => 'proxy:nginx:compile',
            ]);

            $output = new EchoStreamOutput(fopen('php://stdout', 'w'), OutputInterface::VERBOSITY_NORMAL, true);
            $application->run($input, $output);
        });
    }

    public function certificatedumpAction()
    {
        $application = new Application($this->container->get('kernel'));
        $application->setAutoExit(false);

        return new StreamedResponse(function() use ($application) {

            $input = new ArrayInput([
                'command' => 'proxy:certificate:dump',
            ]);

            $output = new EchoStreamOutput(fopen('php://stdout', 'w'), OutputInterface::VERBOSITY_NORMAL, true);
            $application->run($input, $output);
        });
    }


    public function checkconfigAction()
    {
        $application = new Application($this->container->get('kernel'));
        $application->setAutoExit(false);

        return new StreamedResponse(function() use ($application) {

            $input = new ArrayInput([
                'command' => 'proxy:nginx:checkconfig',
            ]);

            $output = new EchoStreamOutput(fopen('php://stdout', 'w'), OutputInterface::VERBOSITY_NORMAL, true);
            $application->run($input, $output);
        });
    }


}

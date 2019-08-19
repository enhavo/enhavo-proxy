<?php

namespace App\Controller;

use Enhavo\Bundle\AppBundle\Controller\AbstractViewController;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Enhavo\Bundle\AppBundle\Output\EchoStreamOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

class VarnishController extends AbstractViewController
{
    public function indexAction()
    {
        $view = $this->viewFactory->create('varnish', [

        ]);

        return $this->viewHandler->handle($view);
    }

    public function restartAction()
    {
        $application = new Application($this->container->get('kernel'));
        $application->setAutoExit(false);

        return new StreamedResponse(function() use ($application) {

            $input = new ArrayInput([
                'command' => 'proxy:varnish:restart',
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
                'command' => 'proxy:varnish:compile',
            ]);

            $output = new EchoStreamOutput(fopen('php://stdout', 'w'), OutputInterface::VERBOSITY_NORMAL, true);
            $application->run($input, $output);
        });
    }
}

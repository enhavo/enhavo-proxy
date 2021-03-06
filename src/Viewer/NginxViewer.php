<?php
/**
 * Created by PhpStorm.
 * User: gseidel
 * Date: 2019-08-19
 * Time: 21:16
 */

namespace App\Viewer;

use Enhavo\Bundle\AppBundle\Viewer\AbstractActionViewer;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NginxViewer extends AbstractActionViewer
{
    protected function createActions($options)
    {
        return [
            'restart' => [
                'type' => 'output_stream',
                'route' => 'app_nginx_restart',
                'label' => 'Restart',
                'icon' => 'replay'
            ],
            'compile' => [
                'type' => 'output_stream',
                'route' => 'app_nginx_compile',
                'label' => 'Compile',
                'icon' => 'build'
            ],
            'dump' => [
                'type' => 'output_stream',
                'route' => 'app_nginx_certificatedump',
                'label' => 'Dump Certificates',
                'icon' => 'wrap_text'
            ],
            'checkconfig' => [
                'type' => 'output_stream',
                'route' => 'app_nginx_checkconfig',
                'label' => 'Check Config',
                'icon' => 'check'
            ]
        ];
    }

    public function configureOptions(OptionsResolver $optionsResolver)
    {
        parent::configureOptions($optionsResolver);
        $optionsResolver->setDefaults([
            'stylesheets' => [
                'enhavo/nginx'
            ],
            'javascripts' => [
                'enhavo/nginx'
            ],
            'label' => 'Nginx'
        ]);
    }

    public function getType()
    {
        return 'nginx';
    }
}

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

class VarnishViewer extends AbstractActionViewer
{
    protected function createActions($options)
    {
        return [
            'restart' => [
                'type' => 'output_stream',
                'route' => 'app_varnish_restart',
                'label' => 'Restart',
                'icon' => 'replay'
            ],
            'compile' => [
                'type' => 'output_stream',
                'route' => 'app_varnish_compile',
                'label' => 'Compile',
                'icon' => 'build'
            ],
            'testconfig' => [
                'type' => 'output_stream',
                'route' => 'app_varnish_testconfig',
                'label' => 'Test Config',
                'icon' => 'check'
            ]
        ];
    }

    public function configureOptions(OptionsResolver $optionsResolver)
    {
        parent::configureOptions($optionsResolver);
        $optionsResolver->setDefaults([
            'stylesheets' => [
                'enhavo/varnish'
            ],
            'javascripts' => [
                'enhavo/varnish'
            ],
            'label' => 'Varnish'
        ]);
    }

    public function getType()
    {
        return 'varnish';
    }
}

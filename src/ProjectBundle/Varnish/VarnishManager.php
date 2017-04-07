<?php
/**
 * VarnishManager.php
 *
 * @since 07/04/17
 * @author gseidel
 */

namespace ProjectBundle\Varnish;


class VarnishManager
{
    public function restart()
    {
        exec('service varnish restart');
    }

    public function testConfig()
    {
        exec('varnishd -C -f /etc/varnish/config.vcl');
    }
}
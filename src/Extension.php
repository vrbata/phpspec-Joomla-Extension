<?php

namespace Symla\PhpSpec\Joomla;

use Symla\Joomla\Cli\CliBootstrap;
use PhpSpec\ServiceContainer;

class Extension implements \PhpSpec\Extension
{
    /**
     * @param ServiceContainer $container
     * @param array            $params
     */
    public function load(ServiceContainer $container, array $params)
    {
        $this->loadJoomla($params);
    }

    /**
     * Boot up Joomla
     *
     * @param array $params
     */
    private function loadJoomla(array $params)
    {
        define('SYMLA_PATH_ROOT', $params['base_path']);

        CliBootstrap::bootstrap();
    }
}
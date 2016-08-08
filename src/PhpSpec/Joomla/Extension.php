<?php

namespace Symla\PhpSpec\Joomla;

use Symla\Joomla\Cli\CliBootstrap;
use PhpSpec\Extension\ExtensionInterface;
use PhpSpec\ServiceContainer;

class Extension implements ExtensionInterface
{
    /**
     * @param ServiceContainer $container
     */
    public function load(ServiceContainer $container)
    {
        $this->loadJoomla();
    }

    /**
     * Boot up Joomla
     */
    private function loadJoomla()
    {
        CliBootstrap::bootstrap();
    }
}
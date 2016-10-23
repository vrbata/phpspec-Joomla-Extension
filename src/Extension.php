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
        
        $url  = parse_url($params['base_url']);
        $path = $url['path'] ?? '';

        $_SERVER['HTTP_HOST']    = $url['host'];
        $_SERVER['HTTPS']        = $url['scheme'] === 'http' ? '' : $url['scheme'];
        $_SERVER['PHP_SELF']     = $path . '/index.php';
        $_SERVER['REQUEST_URI']  = $path;
        $_SERVER['SCRIPT_NAME']  = $path . '/index.php';
        $_SERVER['QUERY_STRING'] = '';

        $application = \JFactory::getApplication('site');
        $reflection  = new \ReflectionClass(\JApplicationSite::class);
        $method      = $reflection->getMethod('initialiseApp');

        $method->setAccessible(true);
        $method->invoke($application);

        restore_error_handler();
    }
}
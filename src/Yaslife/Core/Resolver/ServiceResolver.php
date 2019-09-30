<?php

namespace Yaslife\Core\Resolver;

use Yaslife\Core\Container\ContainerInterface;
use Yaslife\Core\Kernel\Application;

trait ServiceResolver
{
    public function hasService(string $interface)
    {
        $container = $this->getContainer();

        return $container->has($interface);
    }

    /**
     * @param string $interface
     *
     * @return Object
     */
    public function getService(string $interface)
    {
        $container = $this->getContainer();

        return $container->get($interface);
    }

    /**
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return Application::getContainer();
    }
}

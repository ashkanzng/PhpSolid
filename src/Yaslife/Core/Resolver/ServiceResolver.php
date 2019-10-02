<?php

namespace Yaslife\Core\Resolver;

use Yaslife\Core\Container\ContainerInterface;
use Yaslife\Core\Kernel\Application;

trait ServiceResolver
{
    /**
     * @param string $interface
     *
     * @return bool
     */
    public function hasService(string $interface): bool
    {
        $container = $this->getContainer();

        return $container->has($interface);
    }
    /**
     * @param string $interface
     *
     * @return object
     */
    public function getService(string $interface)
    {
        $container = $this->getContainer();

        return $container->get($interface);
    }

    /**
     * @return ContainerInterface
     */
    protected function getContainer(): ContainerInterface
    {
        return Application::getContainer();
    }
}
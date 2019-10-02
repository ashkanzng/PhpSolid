<?php

namespace Yaslife\Core\Container;

interface ContainerInterface
{
    /**
     * @param string $interface
     * @param string $class
     *
     * @return ContainerInterface
     */
    public function register(string $interface, string $class): ContainerInterface;

    /**
     * @param string $interface
     *
     * @return bool
     */
    public function has(string $interface): bool;

    /**
     * @param string $interface
     *
     * @return object
     */
    public function get(string $interface);
}

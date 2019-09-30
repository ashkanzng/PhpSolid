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
    public function register(string $interface, string $class);

    /**
     * @param string $interface
     *
     * @return bool
     */
    public function has(string $interface);

    /**
     * @param string $interface
     *
     * @return Object
     */
    public function get(string $interface);
}

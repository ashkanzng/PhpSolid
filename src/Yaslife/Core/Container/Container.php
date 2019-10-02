<?php

namespace Yaslife\Core\Container;

use Yaslife\Core\Exception\ServiceNotFoundException;

class Container implements ContainerInterface
{
    /**
     * @var string[]
     */
    protected $services = [];

    /**
     * @var object[]
     */
    protected $instances = [];

    /**
     * @param string $interface
     * @param string $class
     *
     * @return ContainerInterface
     */
    public function register(string $interface, string $class): ContainerInterface
    {
        $this->services[$interface] = $class;

        return $this;
    }

    /**
     * @param string $interface
     *
     * @return bool
     */
    public function has(string $interface): bool
    {
        if (isset($this->services[$interface]) && $this->services[$interface] !== null) {
            return true;
        }

        return false;
    }

    /**
     * @param string $interface
     *
     * @return object
     */
    public function get(string $interface)
    {
        if (isset($this->instances[$interface])) {
            return $this->instances[$interface];
        }

        if (!isset($this->services[$interface])) {
            throw new ServiceNotFoundException(sprintf('`%s` has not been found in Service Registry.', $interface));
        }

        $class = $this->services[$interface];
        $this->instances[$interface] = new $class;

        return $this->instances[$interface];
    }
}

<?php

namespace Yaslife\Core\Container;

use Yaslife\Core\Exception\ServiceNotFoundException;

class Container implements ContainerInterface
{
    /**
     * @var Object[]
     */
    protected $services = [];

    /**
     * @var array
     */
    protected $instances = [];

    /**
     * @param string $interface
     * @param string $class
     *
     * @return ContainerInterface
     */
    public function register(string $interface, string $class)
    {
        $this->services[$interface] = $class;

        return $this;
    }

    /**
     * @param string $interface
     *
     * @return bool
     */
    public function has(string $interface)
    {
        if (isset($this->services[$interface]) && $this->services[$interface] !== null) {
            return true;
        }

        return false;
    }

    /**
     * @param string $interface
     *
     * @return Object
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

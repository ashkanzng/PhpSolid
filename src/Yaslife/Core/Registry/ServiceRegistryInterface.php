<?php

namespace Yaslife\Core\Registry;

use Yaslife\Core\Container\ContainerInterface;

interface ServiceRegistryInterface
{

    /**
     * @param ContainerInterface $container
     *
     * @return void
     */
    public function register(ContainerInterface $container);
}

<?php

namespace Yaslife;

use Yaslife\Core\Container\ContainerInterface;
use Yaslife\Core\Registry\ServiceRegistryInterface;
use Yaslife\Service\Country\CountryService;
use Yaslife\Service\Country\CountryServiceInterface;

class ServiceRegistry implements ServiceRegistryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return void
     */
    public function register(ContainerInterface $container)
    {
        $container->register(CountryServiceInterface::class, CountryService::class);
    }
}

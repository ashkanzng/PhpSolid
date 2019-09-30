<?php

namespace Yaslife\Core\Kernel;

use Yaslife\Core\Container\Container;
use Yaslife\Core\Container\ContainerInterface;
use Yaslife\Core\Registry\ServiceRegistryInterface;
use Yaslife\Core\Resolver\ConfigResolver;

class Application
{
    use ConfigResolver;

    /**
     * @var ContainerInterface
     */
    protected static $container;

    /**
     * @return ContainerInterface
     */
    public static function getContainer()
    {
        return static::$container;
    }

    /**
     * @return $this
     */
    public function boot()
    {
        if (static::$container === null) {
            $container = new Container();
            $this->registerServices($container);

            static::$container = $container;
        }

        return $this;
    }

    /**
     * @param array $argv
     *
     * @return void
     */
    public function run(array $argv)
    {
        $commandRunner = new CommandRunner();
        $commandRunner->run($argv);
    }

    /**
     * @param ContainerInterface $container
     *
     * @return void
     */
    protected function registerServices(ContainerInterface $container): void
    {
        $serviceRegistryClassName = $this->getApplicationConfig()->getProjectServiceRegistry();
        /** @var ServiceRegistryInterface $serviceRegistry */
        $serviceRegistry = new $serviceRegistryClassName;
        $serviceRegistry->register($container);
    }
}

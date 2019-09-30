<?php

namespace Yaslife\Core\Kernel;

use ArrayObject;
use Yaslife\Core\Registry\CommandRegistryInterface;
use Yaslife\Core\Resolver\ConfigResolver;

class CommandRunner
{
    use ConfigResolver;

    /**
     * @var AbstractCommand[]
     */
    protected $commands;

    /**
     * @param array $argv
     *
     * @return void
     */
    public function run(array $argv)
    {
        $this->registerCommands();

        foreach ($this->commands as $command) {
            $command->run($argv);
        }
    }

    /**
     * @return void
     */
    protected function registerCommands()
    {
        $commandRegistryClassName = $this->getApplicationConfig()->getProjectcommandRegistry();
        /** @var CommandRegistryInterface $commandRegistry */
        $commandRegistry = new $commandRegistryClassName;
        $this->commands = new ArrayObject();
        $commandRegistry->register($this->commands);
    }
}

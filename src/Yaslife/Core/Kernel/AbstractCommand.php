<?php

namespace Yaslife\Core\Kernel;

use Yaslife\Core\Resolver\ServiceResolver;

abstract class AbstractCommand
{
    use ServiceResolver;

    /**
     * @param array $argv
     *
     * @return void
     */
    abstract public function run(array $argv): void;
}

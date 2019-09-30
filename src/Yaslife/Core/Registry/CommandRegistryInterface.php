<?php

namespace Yaslife\Core\Registry;

use ArrayObject;

interface CommandRegistryInterface
{
    /**
     * @param ArrayObject $commands
     *
     * @return void
     */
    public function register(ArrayObject $commands);
}

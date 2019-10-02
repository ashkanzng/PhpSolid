<?php

namespace Yaslife;

use ArrayObject;
use Yaslife\Command\CountryLanguageIntersectionCommandRunner;
use Yaslife\Command\CountryLanguageCommandRunner;
use Yaslife\Core\Registry\CommandRegistryInterface;

class CommandRegistry implements CommandRegistryInterface
{
    /**
     * @param ArrayObject $commands
     *
     * @return void
     */
    public function register(ArrayObject $commands):void
    {
        $commands->append(new CountryLanguageCommandRunner());
        $commands->append(new CountryLanguageIntersectionCommandRunner());
    }
}

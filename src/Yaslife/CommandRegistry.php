<?php

namespace Yaslife;

use ArrayObject;
use Yaslife\Command\CountryLanguageComparatorCommandRunner;
use Yaslife\Command\CountrySameLanguageListCommandRunner;
use Yaslife\Core\Registry\CommandRegistryInterface;

class CommandRegistry implements CommandRegistryInterface
{
    /**
     * @param ArrayObject $commands
     *
     * @return void
     */
    public function register(ArrayObject $commands)
    {
        $commands->append(new CountrySameLanguageListCommandRunner());
        $commands->append(new CountryLanguageComparatorCommandRunner());
    }
}

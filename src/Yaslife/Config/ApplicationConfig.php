<?php

namespace Yaslife\Config;

use Yaslife\CommandRegistry;
use Yaslife\ServiceRegistry;

class ApplicationConfig
{
    /**
     * @return string
     */
    public function getProjectServiceRegistry()
    {
        return ServiceRegistry::class;
    }

    /**
     * @return string
     */
    public function getProjectCommandRegistry()
    {
        return CommandRegistry::class;
    }

    /**
     * @return string
     */
    public function getCountryApiRestUrl(): string
    {
        return 'https://restcountries.eu/rest/v2/';
    }
}

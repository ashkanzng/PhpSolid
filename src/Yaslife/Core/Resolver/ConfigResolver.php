<?php

namespace Yaslife\Core\Resolver;

use Yaslife\Config\ApplicationConfig;

trait ConfigResolver
{
    /**
     * @return ApplicationConfig
     */
    protected function getApplicationConfig(): ApplicationConfig
    {
        return new ApplicationConfig();
    }
}

<?php

namespace Yaslife\Core\Resolver;

use Yaslife\Config\ApplicationConfig;

trait ConfigResolver
{
    /**
     * @return ApplicationConfig
     */
    protected function getApplicationConfig()
    {
        return new ApplicationConfig();
    }
}

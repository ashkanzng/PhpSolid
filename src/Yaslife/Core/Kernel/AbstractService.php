<?php

namespace Yaslife\Core\Kernel;

use Yaslife\Service\ServiceFactory;

/**
 * This is the abstract factory for Service layer
 */
abstract class AbstractService
{
    /**
     * @return ServiceFactory
     */
    public function getFactory()
    {
        return new ServiceFactory();
    }
}

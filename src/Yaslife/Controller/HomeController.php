<?php

namespace Yaslife\Controller;

use Yaslife\Core\Kernel\AbstractController;
use Yaslife\Service\Country\CountryServiceInterface;

class HomeController extends AbstractController
{

    public function index()
    {
        $countryService = $this->getService(CountryServiceInterface::class);
    }
}

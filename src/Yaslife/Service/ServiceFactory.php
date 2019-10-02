<?php

namespace Yaslife\Service;

use Yaslife\Core\Resolver\ConfigResolver;
use Yaslife\Service\Country\Model\CountryLanguageComparator;
use Yaslife\Service\Country\Model\CountryLanguageComparatorInterface;
use Yaslife\Service\Country\Model\CountryRest;
use Yaslife\Service\Country\Model\CountryRestInterface;
use Yaslife\Service\Country\Model\CountrySameLanguageFinder;
use Yaslife\Service\Country\Model\CountrySameLanguageFinderInterface;
use Yaslife\Service\Http\Model\Http;
use Yaslife\Service\Http\Model\HttpInterface;
use Yaslife\Service\Validation\Model\InputStringLengthValidator;
use Yaslife\Service\Validation\Model\InputStringLengthValidatorInterface;

class ServiceFactory
{
    use ConfigResolver;

    /**
     * @return CountrySameLanguageFinderInterface
     */
    public function createCountrySameLanguageFinder(): CountrySameLanguageFinderInterface
    {
        return new CountrySameLanguageFinder(
            $this->createInputStringLengthValidator(),
            $this->createCountryRest()
        );
    }

    /**
     * @return CountryLanguageComparatorInterface
     */
    public function createCountryLanguageComparator(): CountryLanguageComparatorInterface
    {
        return new CountryLanguageComparator(
            $this->createInputStringLengthValidator(),
            $this->createCountrySameLanguageFinder()
        );
    }

    /**
     * @return CountryRestInterface
     */
    public function createCountryRest(): CountryRestInterface
    {
        return new CountryRest($this->createHttp());
    }

    /**
     * @return InputStringLengthValidatorInterface
     */
    public function createInputStringLengthValidator(): InputStringLengthValidatorInterface
    {
        return new InputStringLengthValidator();
    }

    /**
     * @return HttpInterface
     */
    public function createHttp(): HttpInterface
    {
        return new Http($this->getApplicationConfig()->getCountryApiRestUrl());
    }
}

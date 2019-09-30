<?php

namespace Yaslife\Service;

use Yaslife\Core\Resolver\ConfigResolver;
use Yaslife\Service\Country\Model\CountryLanguageComparator;
use Yaslife\Service\Country\Model\CountryLanguageComparatorInterface;
use Yaslife\Service\Country\Model\CountrySameLanguageFinder;
use Yaslife\Service\Country\Model\CountrySameLanguageFinderInterface;
use Yaslife\Service\CountryRest\Model\CountryRest;
use Yaslife\Service\Validation\Model\InputStringLengthValidator;
use Yaslife\Service\Validation\Model\InputStringLengthValidatorInterface;

class ServiceFactory
{
    use ConfigResolver;

    /**
     * @return CountrySameLanguageFinderInterface
     */
    public function createCountrySameLanguageFinder()
    {
        return new CountrySameLanguageFinder(
            $this->createInputStringLengthValidator(),
            $this->createHttpRequest()
        );
    }

    /**
     * @return CountryLanguageComparatorInterface
     */
    public function createCountryLanguageComparator()
    {
        return new CountryLanguageComparator(
            $this->createInputStringLengthValidator(),
            $this->createHttpRequest()
        );
    }

    /**
     * @return InputStringLengthValidatorInterface
     */
    public function createInputStringLengthValidator()
    {
        return new InputStringLengthValidator();
    }

    /**
     * @return CountryRest
     */
    public function createHttpRequest()
    {
        return new CountryRest($this->getApplicationConfig()->getCountryApiRestUrl());
    }
}

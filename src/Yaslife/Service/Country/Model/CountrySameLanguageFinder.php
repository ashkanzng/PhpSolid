<?php

namespace Yaslife\Service\Country\Model;

use Yaslife\Dto\CountryLanguageDto;
use Yaslife\Service\Validation\Model\InputStringLengthValidatorInterface;

class CountrySameLanguageFinder implements CountrySameLanguageFinderInterface
{
    /**
     * @var InputStringLengthValidatorInterface
     */
    protected $inputStringLengthValidator;

    /**
     * @var CountryRestInterface
     */
    protected $countryRest;

    /**
     * CountrySameLanguageFinder constructor.
     *
     * @param InputStringLengthValidatorInterface $inputStringLengthValidator
     * @param CountryRestInterface $countryRest
     */
    public function __construct(InputStringLengthValidatorInterface $inputStringLengthValidator, CountryRestInterface $countryRest)
    {
        $this->inputStringLengthValidator = $inputStringLengthValidator;
        $this->countryRest = $countryRest;
    }

    /**
     * @param string $country
     *
     * @return CountryLanguageDto
     */
    public function findAllCountriesWithSameLanguages(string $country): CountryLanguageDto
    {
        $countryLanguageDto =  new CountryLanguageDto();
        $this->inputStringLengthValidator->validate($country, 3);

        $languages = $this->countryRest->findAllLanguagesByCountry($country);

        if (!$languages) {
            return $countryLanguageDto;
        }

        $countries = [];
        foreach ($languages as $language) {
            $countries = array_merge($countries, $this->countryRest->findAllCountriesWithSameLanguage($language));
        }

        $countries = array_column($countries, 'name');

        $countryLanguageDto->setLanguages($languages);
        $countryLanguageDto->setCountries($countries);

        return $countryLanguageDto;
    }
}

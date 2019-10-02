<?php

namespace Yaslife\Service\Country\Model;

use Yaslife\Dto\CountryLanguageDto;
use Yaslife\Service\Validation\Model\InputStringLengthValidatorInterface;

class CountryLanguageComparator implements CountryLanguageComparatorInterface
{
    /**
     * @var InputStringLengthValidatorInterface
     */
    protected $inputStringLengthValidator;

    /**
     * @var CountrySameLanguageFinderInterface
     */
    protected $countrySameLanguageFinder;

    /**
     * @param InputStringLengthValidatorInterface $inputStringLengthValidator
     * @param CountrySameLanguageFinderInterface $countrySameLanguageFinder
     */
    public function __construct(InputStringLengthValidatorInterface $inputStringLengthValidator, CountrySameLanguageFinderInterface $countrySameLanguageFinder)
    {
        $this->inputStringLengthValidator = $inputStringLengthValidator;
        $this->countrySameLanguageFinder = $countrySameLanguageFinder;
    }

    /**
     * @param string[] $countries
     *
     * @return CountryLanguageDto
     */
    public function findAllCountriesIntersectionWithSameLanguages(array $countries): CountryLanguageDto
    {
        $intersection = [];
        $countryLanguageDtos = $this->findLanguagesByCountries($countries);

        foreach ($countryLanguageDtos as $countryLanguageDto) {
            $intersection[] = array_intersect($countries, $countryLanguageDto->getCountries());
        }

        $countryLanguageDto = new CountryLanguageDto();
        $countryLanguageDto->setCountries($countries);
        $countryLanguageDto->setIntersection($intersection);

        return $countryLanguageDto;
    }

    /**
     * @param string[] $countries
     *
     * @return CountryLanguageDto[]
     */
    protected function findLanguagesByCountries(array $countries): array
    {
        $countryLanguageDtos = [];
        foreach ($countries as $country) {
            $this->inputStringLengthValidator->validate($country, 3);
            $countryLanguageDtos[] = $this->countrySameLanguageFinder->findAllCountriesWithSameLanguages($country);
        }

        return $countryLanguageDtos;
    }
}

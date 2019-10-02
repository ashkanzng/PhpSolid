<?php

namespace Yaslife\Service\Country;

use Yaslife\Core\Kernel\AbstractService;
use Yaslife\Dto\CountryLanguageDto;

class CountryService extends AbstractService implements CountryServiceInterface
{
    /**
     * @param string $country
     *
     * @return CountryLanguageDto
     */
    public function findAllCountriesWithSameLanguagesByCountry(string $country): CountryLanguageDto
    {
        return $this->getFactory()->createCountrySameLanguageFinder()->findAllCountriesWithSameLanguages($country);
    }

    /**
     * @param string[] $countries
     *
     * @return CountryLanguageDto
     */
    public function findAllCountriesIntersectionWithSameLanguages(array $countries): CountryLanguageDto
    {
        return $this->getFactory()->createCountryLanguageComparator()->findAllCountriesIntersectionWithSameLanguages($countries);
    }
}

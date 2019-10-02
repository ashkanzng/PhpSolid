<?php

namespace Yaslife\Service\Country;

use Yaslife\Dto\CountryLanguageDto;

interface CountryServiceInterface
{
    /**
     * @param string $country
     *
     * @return CountryLanguageDto
     */
    public function findAllCountriesWithSameLanguagesByCountry(string $country): CountryLanguageDto;

    /**
     * @param string[] $countries
     *
     * @return CountryLanguageDto
     */
    public function findAllCountriesIntersectionWithSameLanguages(array $countries): CountryLanguageDto;
}

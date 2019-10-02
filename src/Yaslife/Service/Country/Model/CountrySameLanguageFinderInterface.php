<?php

namespace Yaslife\Service\Country\Model;

use Yaslife\Dto\CountryLanguageDto;

interface CountrySameLanguageFinderInterface
{
    /**
     * @param string $country
     *
     * @return CountryLanguageDto
     */
    public function findAllCountriesWithSameLanguages(string $country): CountryLanguageDto;
}

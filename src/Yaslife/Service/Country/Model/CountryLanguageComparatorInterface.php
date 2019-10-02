<?php

namespace Yaslife\Service\Country\Model;

use Yaslife\Dto\CountryLanguageDto;

interface CountryLanguageComparatorInterface
{
    /**
     * @param string[] $countries
     *
     * @return CountryLanguageDto
     */
    public function findAllCountriesIntersectionWithSameLanguages(array $countries): CountryLanguageDto;
}

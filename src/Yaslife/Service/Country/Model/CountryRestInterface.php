<?php

namespace Yaslife\Service\Country\Model;

interface CountryRestInterface
{
    /**
     * @param string $country
     *
     * @return array
     */
    public function findAllLanguagesByCountry(string $country): array;

    /**
     * @param string $language
     *
     * @return array
     */
    public function findAllCountriesWithSameLanguage(string $language): array;
}

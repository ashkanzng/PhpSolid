<?php

namespace Yaslife\Service\CountryRest\Model;

use Yaslife\Dto\CountryQueryResponseDto;

interface CountryRestInterface
{
    /**
     * @param string $url
     * @return array
     */
    public function sendRequest(string $url): array;

    /**
     * @param string $country
     * @param CountryQueryResponseDto $responseData
     * @return mixed
     */
    public function getCountryLanguages(string $country, CountryQueryResponseDto $responseData);

    /**
     * @param CountryQueryResponseDto $responseData
     * @return array
     */
    public function getAllCountryWithSameLanguage( CountryQueryResponseDto $responseData): array;
}

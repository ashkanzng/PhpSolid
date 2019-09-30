<?php

namespace Yaslife\Service\Country\Model;

use Yaslife\Dto\CountryQueryRequestDto;
use Yaslife\Dto\CountryQueryResponseDto;

interface CountrySameLanguageFinderInterface
{
    /**
     * @param CountryQueryRequestDto $countryQueryRequestDto
     *
     * @return CountryQueryResponseDto
     */
    public function sendCountrySameLanguageRequest(CountryQueryRequestDto $countryQueryRequestDto): CountryQueryResponseDto;
}

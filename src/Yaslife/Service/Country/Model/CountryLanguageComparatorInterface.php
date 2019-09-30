<?php

namespace Yaslife\Service\Country\Model;

use Yaslife\Dto\CountryQueryRequestDto;
use Yaslife\Dto\CountryQueryResponseDto;

interface CountryLanguageComparatorInterface
{
    /**
     * @param CountryQueryRequestDto $countryQueryRequestDto
     *
     * @return CountryQueryResponseDto
     */
    public function sendCountryLanguageComparatorRequest(CountryQueryRequestDto $countryQueryRequestDto): CountryQueryResponseDto;
}

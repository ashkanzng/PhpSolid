<?php

namespace Yaslife\Service\Country;

use Yaslife\Core\Kernel\AbstractService;
use Yaslife\Dto\CountryQueryRequestDto;
use Yaslife\Dto\CountryQueryResponseDto;

class CountryService extends AbstractService implements CountryServiceInterface
{
    /**
     * @param CountryQueryRequestDto $countryQueryRequestDto
     *
     * @return CountryQueryResponseDto
     */
    public function sendCountrySameLanguageRequest(CountryQueryRequestDto $countryQueryRequestDto): CountryQueryResponseDto
    {
        return $this->getFactory()->createCountrySameLanguageFinder()->sendCountrySameLanguageRequest($countryQueryRequestDto);
    }

    /**
     * @param CountryQueryRequestDto $countryQueryRequestDto
     *
     * @return CountryQueryResponseDto
     */
    public function sendCountryLanguageComparatorRequest(CountryQueryRequestDto $countryQueryRequestDto): CountryQueryResponseDto
    {
        return $this->getFactory()->createCountryLanguageComparator()->sendCountryLanguageComparatorRequest($countryQueryRequestDto);
    }
}

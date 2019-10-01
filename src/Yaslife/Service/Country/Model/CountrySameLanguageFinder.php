<?php

namespace Yaslife\Service\Country\Model;

use Yaslife\Dto\CountryQueryRequestDto;
use Yaslife\Dto\CountryQueryResponseDto;
use Yaslife\Service\CountryRest\Model\CountryRestInterface;
use Yaslife\Service\Validation\Model\InputStringLengthValidatorInterface;

class CountrySameLanguageFinder implements CountrySameLanguageFinderInterface
{
    /**
     * @var InputStringLengthValidatorInterface
     */
    protected $inputStringLengthValidator;

    /**
     * @var CountryRestInterface
     */
    protected $countryRest;

    /**
     * CountrySameLanguageFinder constructor.
     * @param InputStringLengthValidatorInterface $inputStringLengthValidator
     * @param CountryRestInterface $countryRest
     */
    public function __construct(InputStringLengthValidatorInterface $inputStringLengthValidator, CountryRestInterface $countryRest)
    {
        $this->inputStringLengthValidator = $inputStringLengthValidator;
        $this->countryRest = $countryRest;
    }

    /**
     * @param CountryQueryRequestDto $countryQueryRequestDto
     *
     * @return CountryQueryResponseDto
     */
    public function sendCountrySameLanguageRequest(CountryQueryRequestDto $countryQueryRequestDto): CountryQueryResponseDto
    {
        $country = current($countryQueryRequestDto->getCountries());
        $this->inputStringLengthValidator->validate($country, 3);
        $responseData = new CountryQueryResponseDto();

        if ( $this->countryRest->getCountryLanguages($country, $responseData) === true )
        {
            if (!empty( $listOfCountries = $this->countryRest->getAllCountryWithSameLanguage($responseData))){
                $output = 'Country language code: '. $responseData->getResponse() . PHP_EOL;
                $listOfCountries = array_map('current', $listOfCountries);
                $output .= $country . ' speaks same language with these countries: ' . implode(',' ,  $listOfCountries) . PHP_EOL;
                $responseData->setResponse($output);
            }
        };

        return $responseData;
    }

}

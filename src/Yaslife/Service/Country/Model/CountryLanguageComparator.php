<?php

namespace Yaslife\Service\Country\Model;

use Yaslife\Dto\CountryQueryRequestDto;
use Yaslife\Dto\CountryQueryResponseDto;
use Yaslife\Service\CountryRest\Model\CountryRestInterface;
use Yaslife\Service\Validation\Model\InputStringLengthValidatorInterface;

class CountryLanguageComparator implements CountryLanguageComparatorInterface
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
    public function sendCountryLanguageComparatorRequest(CountryQueryRequestDto $countryQueryRequestDto): CountryQueryResponseDto
    {
        foreach ($countryQueryRequestDto->getCountries() as $country) {
            $this->inputStringLengthValidator->validate($country, 3);
        }
        print_r($countryQueryRequestDto->getCountries());
        // logic done!

        $response = new CountryQueryResponseDto();
        $response->setResponse("Spain and Usa has same language\n");

        return $response;
    }
}

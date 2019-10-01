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

        if ( $this->getCountryLanguages($country, $responseData) === true )
        {
            $this->getAllCountryWithSameLanguage($responseData);
        };
        return $responseData;
    }

    /**
     * @param array $data
     * @return bool
     */
    protected function checkResult(array $data )
    {
        if (isset($data['Code'])){
            return false;
        }
        return true;
    }

    /**
     * @param string $country
     * @param CountryQueryResponseDto $responseData
     * @return bool
     */
    protected function getCountryLanguages(string $country, CountryQueryResponseDto $responseData): bool
    {
        $url = 'name/'.$country.'?fullText=true&fields=name;languages';
        $restResult = $this->countryRest->sendRequest($url);

        if ($this->checkResult( reset($restResult) ) === false){
            $responseData->setResponse( 'Country ' .reset($restResult)['Message']);
            return false;
        }
        $responseData->setResponse( current(reset($restResult)['languages'])['iso639_1'] );
        return true;
    }

    /**
     * @param CountryQueryResponseDto $responseData
     */
    protected function getAllCountryWithSameLanguage( CountryQueryResponseDto $responseData): void
    {
        $language = $responseData->getResponse();
        $url = 'lang/'.$language.'?fields=name';
        $restResult = $this->countryRest->sendRequest($url);

        if ($this->checkResult( reset($restResult) ) === false){
            $responseData->setResponse('Language ' .reset($restResult)['Message']);
            return;
        }
        $output = '';
        foreach ($restResult as $value){
            $output .= $value['name'] . ', ';
        }
        $responseData->setResponse(
            $output . PHP_EOL
        );
        return;
    }

}

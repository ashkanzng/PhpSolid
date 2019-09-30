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

        $result = new CountryQueryResponseDto();
        $url = 'name/'.$country.'?fullText=true&fields=name;languages';
        $data = $this->countryRest->sendRequest($url);
        $this->processData($data,$result);

        return $result;
    }

    public function processData(array $data, CountryQueryResponseDto $result)
    {
        $data = reset($data);
        if (isset($data['Code'])){
            $result->setResponse($data['Message']);
            return;
        }
        if (isset($data['languages'])){
            $countryLanguageCode = current($data['languages'])['iso639_1'];
            $result->setResponse($countryLanguageCode);
            return;
        }
        $result->setResponse('Country Not Found');
    }
}

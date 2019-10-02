<?php

namespace Yaslife\Service\Country\Model;

use Yaslife\Service\Http\Model\HttpInterface;

class CountryRest implements CountryRestInterface
{
    protected const LANGUAGE_BY_COUNTRY_REST_URL = 'name/%s?fullText=true&fields=name;languages';
    protected const COUNTRIES_WITH_SAME_LANG_URL = 'lang/%s?fields=name';

    /**
     * @var HttpInterface
     */
    protected $http;

    /**
     * @param HttpInterface $http
     */
    public function __construct(HttpInterface $http)
    {
        $this->http = $http;
    }

    /**
     * @param string $language
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return array
     */
    public function findAllCountriesWithSameLanguage(string $language): array
    {
        $url = sprintf(static::COUNTRIES_WITH_SAME_LANG_URL, $language);

        return $this->http->sendRequest($url);
    }

    /**
     * @param string $country
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return array
     */
    public function findAllLanguagesByCountry(string $country): array
    {
        $languages = [];
        $url = sprintf(static::LANGUAGE_BY_COUNTRY_REST_URL, $country);
        $response = $this->http->sendRequest($url);
        $responseLanguage = current($response);

        if (!isset($responseLanguage['languages'])) {
            return [];
        }

        foreach ($responseLanguage['languages'] as $language) {
            $languages[] = $language['iso639_1'];
        }

        return $languages;
    }
}

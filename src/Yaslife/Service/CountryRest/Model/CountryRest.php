<?php

namespace Yaslife\Service\CountryRest\Model;
use GuzzleHttp\Client;
use Yaslife\Dto\CountryQueryResponseDto;

class CountryRest implements CountryRestInterface
{
    /**
     * @var object Client
     */
    protected $client;

    /**
     * @param string $baseUrl
     */
    public function __construct(string $baseUrl)
    {
        $this->client = new Client([
            'base_uri' => $baseUrl,
            'timeout'  => 2.0,
        ]);
    }

    /**
     * @param string $url
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendRequest(string $url): array
    {
        try{
            $req = $this->client->request('GET',$url);
            return json_decode($req->getBody(),true);
        }catch (\Exception $e) {
            return [
                [
                    'Code'=>$e->getCode(),
                    'Message'=>'Not Found'
                ]
            ];
        }
    }

    /**
     * @param string $country
     * @param CountryQueryResponseDto $responseData
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCountryLanguages(string $country, CountryQueryResponseDto $responseData): bool
    {
        $url = 'name/'.$country.'?fullText=true&fields=name;languages';
        $restResult = $this->sendRequest($url);

        if ($this->checkResult( reset($restResult) ) === false){
            $responseData->setResponse( 'Country ' .reset($restResult)['Message'] . PHP_EOL);
            return false;
        }
        $responseData->setResponse( current(reset($restResult)['languages'])['iso639_1'] );
        return true;
    }

    /**
     * @param CountryQueryResponseDto $responseData
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllCountryWithSameLanguage( CountryQueryResponseDto $responseData): array
    {
        $language = $responseData->getResponse();
        $url = 'lang/' . $language . '?fields=name';
        $restResult = $this->sendRequest($url);

        if ($this->checkResult(reset($restResult)) === false) {
            $responseData->setResponse('Language ' . reset($restResult)['Message'] . PHP_EOL);
            return [];
        }
//        $output = '';
//        foreach ($restResult as $value) {
//            $output .= $value['name'] . ', ';
//        }
//        $responseData->setResponse(
//            $output . PHP_EOL
//        );
        return $restResult;
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

}

<?php

namespace Yaslife\Service\CountryRest\Model;
use GuzzleHttp\Client;

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
     *
     * @return array
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
                    'Message'=>'Country Not Found'
                ]
            ];
        }
    }
}

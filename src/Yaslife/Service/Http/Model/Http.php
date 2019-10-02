<?php

namespace Yaslife\Service\Http\Model;

use GuzzleHttp\Client;

class Http implements HttpInterface
{
    protected const API_TIMEOUT = 2;
    protected const METHOD_GET = 'GET';

    /**
     * @param string $baseUrl
     */
    protected $baseUrl;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @param string $baseUrl
     */
    public function __construct(string $baseUrl)
    {
        $this->client = new Client([
            'base_uri' => $baseUrl,
            'timeout' => static::API_TIMEOUT,
        ]);
    }

    /**
     * @param string $url
     *
     * @return array
     */
    public function sendRequest(string $url): array
    {
        try {
            $request = $this->client->request(static::METHOD_GET, $url);

            return json_decode($request->getBody(), true);
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'message' => 'Not Found',
            ];
        }
    }
}

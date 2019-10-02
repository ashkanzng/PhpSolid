<?php

namespace Yaslife\Service\Http\Model;

interface HttpInterface
{
    /**
     * @param string $url
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendRequest(string $url): array;
}

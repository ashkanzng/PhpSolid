<?php

namespace Yaslife\Service\CountryRest\Model;

interface CountryRestInterface
{
    /**
     * @param string $url
     *
     * @return array
     */
    public function sendRequest(string $url): array;
}

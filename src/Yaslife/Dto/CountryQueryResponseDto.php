<?php

namespace Yaslife\Dto;

class CountryQueryResponseDto
{
    /**
     * @var string
     */
    protected $response;

    /**
     * @return string
     */
    public function getResponse(): string
    {
        return $this->response;
    }

    /**
     * @param string $response
     */
    public function setResponse(string $response): void
    {
        $this->response = $response;
    }
}

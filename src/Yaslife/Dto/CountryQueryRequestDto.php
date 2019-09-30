<?php

namespace Yaslife\Dto;

class CountryQueryRequestDto
{
    /**
     * @var array
     */
    protected $countries = [];

    /**
     * @return array
     */
    public function getCountries(): array
    {
        return $this->countries;
    }

    /**
     * @param array $countries
     */
    public function setCountries(array $countries): void
    {
        $this->countries = $countries;
    }

    /**
     * @param string $country
     *
     * @return CountryQueryRequestDto
     */
    public function addCountry(string $country)
    {
        $this->countries[] = $country;

        return $this;
    }
}

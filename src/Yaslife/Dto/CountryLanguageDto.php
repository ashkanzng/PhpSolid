<?php

namespace Yaslife\Dto;

class CountryLanguageDto
{
    /**
     * @var array
     */
    protected $languages = [];

    /**
     * @var array
     */
    protected $countries = [];

    /**
     * @var array
     */
    protected $intersection = [];

    /**
     * @return array
     */
    public function getIntersection(): array
    {
        return $this->intersection;
    }

    /**
     * @param array $intersection
     */
    public function setIntersection(array $intersection): void
    {
        $this->intersection = $intersection;
    }

    /**
     * @return array
     */
    public function getLanguages(): array
    {
        return $this->languages;
    }

    /**
     * @param array $languages
     */
    public function setLanguages(array $languages): void
    {
        $this->languages = $languages;
    }

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
}

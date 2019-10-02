<?php

namespace Yaslife\Command;

use Yaslife\Core\Kernel\AbstractCommand;
use Yaslife\Dto\CountryLanguageDto;
use Yaslife\Service\Country\CountryServiceInterface;
use Yaslife\Service\Validation\Exception\InvalidStringLengthException;

class CountryLanguageCommandRunner extends AbstractCommand
{
    /**
     * @param array $argv
     *
     * @return void
     */
    public function run(array $argv): void
    {
        array_shift($argv);
        if (!$this->isApplicable($argv))
        {
            return;
        }

        $country = current($argv);
        /** @var CountryServiceInterface $countryService */
        $countryService = $this->getService(CountryServiceInterface::class);

        try {
            $response = $countryService->findAllCountriesWithSameLanguagesByCountry($country);
            $message = $this->createResponseMessage($response, $country);
            echo $message;
        } catch (InvalidStringLengthException $exception) {
            echo $exception->getMessage() . PHP_EOL;
        }
    }

    /**
     * @param CountryLanguageDto $countryLanguageDto
     * @param string $country
     *
     * @return string
     */
    protected function createResponseMessage(CountryLanguageDto $countryLanguageDto, string $country): string
    {
        if (!$countryLanguageDto->getLanguages()) {
            return 'No Result!' . PHP_EOL;
        }

        $message = sprintf('Country language code: %s' . PHP_EOL, implode(',', $countryLanguageDto->getLanguages()));
        $message .= sprintf('%s speaks same language with these countries: %s' . PHP_EOL, $country, implode(',', $countryLanguageDto->getCountries()));

        return $message;
    }


    /**
     * @param array $argv
     *
     * @return bool
     */
    protected function isApplicable(array $argv): bool
    {
        $argumentCount = count($argv);

        return $argumentCount === 1 ? true : false;
    }
}

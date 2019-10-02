<?php

namespace Yaslife\Command;

use Yaslife\Core\Kernel\AbstractCommand;
use Yaslife\Dto\CountryLanguageDto;
use Yaslife\Service\Country\CountryServiceInterface;
use Yaslife\Service\Validation\Exception\InvalidStringLengthException;

class CountryLanguageIntersectionCommandRunner extends AbstractCommand
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

        /** @var CountryServiceInterface $countryService */
        $countryService = $this->getService(CountryServiceInterface::class);
        try {
            $response = $countryService->findAllCountriesIntersectionWithSameLanguages($argv);
            $message = $this->createOutputMessage($response, $argv);
            echo $message . PHP_EOL;
        } catch (InvalidStringLengthException $exception) {
            echo $exception->getMessage() . PHP_EOL;
        }
    }

    /**
     * @param CountryLanguageDto $response
     * @param array $countries
     *
     * @return string
     */
    protected function createOutputMessage(CountryLanguageDto $response, array $countries): string
    {
        $negativeVerb = 'do not ';
        if (count($countries) === count(current($response->getIntersection()))) {
            $negativeVerb = '';
        }

        $message = sprintf('%s %sspeak the same language.', implode(' and ', $countries), $negativeVerb);

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

        return $argumentCount > 1 ? true : false;
    }
}

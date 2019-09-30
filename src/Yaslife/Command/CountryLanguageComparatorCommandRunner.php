<?php

namespace Yaslife\Command;

use Yaslife\Core\Kernel\AbstractCommand;
use Yaslife\Dto\CountryQueryRequestDto;
use Yaslife\Service\Country\CountryServiceInterface;
use Yaslife\Service\Validation\Exception\InvalidStringLengthException;

class CountryLanguageComparatorCommandRunner extends AbstractCommand
{
    /**
     * @param array $argv
     *
     * @return void
     */
    public function run(array $argv)
    {
        array_shift($argv);
        if (!$this->isApplicable($argv))
        {
            return;
        }

        $countryQueryRequestDto = new CountryQueryRequestDto();
        $countryQueryRequestDto->setCountries($argv);

        /** @var CountryServiceInterface $countryService */
        $countryService = $this->getService(CountryServiceInterface::class);
        try {
            $response = $countryService->sendCountryLanguageComparatorRequest($countryQueryRequestDto);
            echo $response->getResponse();
        } catch (InvalidStringLengthException $exception) {
            echo $exception->getMessage() . PHP_EOL;
        }
    }

    /**
     * @param array $argv
     *
     * @return bool
     */
    protected function isApplicable(array $argv)
    {
        $argumentCount = count($argv);

        return $argumentCount > 1 ? true : false;
    }
}

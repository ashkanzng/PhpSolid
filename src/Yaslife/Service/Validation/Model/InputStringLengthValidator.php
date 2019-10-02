<?php

namespace Yaslife\Service\Validation\Model;

use Yaslife\Service\Validation\Exception\InvalidStringLengthException;

class InputStringLengthValidator implements InputStringLengthValidatorInterface
{
    /**
     * @param string $input
     * @param int $length
     *
     * @return void
     */
    public function validate(string $input, int $length): void
    {
        if (strlen($input) < $length) {
            throw new InvalidStringLengthException(
                sprintf('`%s` is not valid input, minimum of input length must not be less than %d character.', $input, $length)
            );
        }
    }
}

<?php

namespace Yaslife\Service\Validation\Model;

interface InputStringLengthValidatorInterface
{
    /**
     * @param string $input
     * @param int $length
     *
     * @return void
     */
    public function validate(string $input, int $length): void;
}

<?php

namespace App\Validators;

class HexColorValidator
{
    public function validate($attribute, $value, $parameters)
    {
        return preg_match('/^((0x){0,1}|#{0,1})([0-9a-fA-F]{8}|[0-9a-fA-F]{6})$/', $value);
    }
}
<?php declare(strict_types=1);

namespace GPCSV\Field;

use GPCSV\Field;
use GPCSV\Exception\InvalidValueException;

class Email extends Field
{
    public function validateValue(string $value): bool
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidValueException($this->name . ' must be in valid email address format');
        }

        return true;
    }
}

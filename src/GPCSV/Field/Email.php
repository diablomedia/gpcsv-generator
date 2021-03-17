<?php

declare(strict_types=1);

namespace GPCSV\Field;

use GPCSV\Exception\InvalidValueException;
use GPCSV\Field;

class Email extends Field
{
    // A different character set is allowed for email, let filter_var take care of it
    public function cleanValue(string $value): string
    {
        return trim($value);
    }

    public function validateValue(string $value): bool
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidValueException($this->name . ' must be in valid email address format');
        }

        return true;
    }
}

<?php declare(strict_types=1);

namespace GPCSV\Field;

use GPCSV\Field;
use GPCSV\Exception\InvalidValueException;

class ValueList extends Field
{
    /** @var array<string> */
    protected $values = [];

    public function validateValue(string $value): bool
    {
        if (in_array($value, $this->values) === false) {
            throw new InvalidValueException($this->name . ' must be one of: ' . implode(', ', $this->values));
        }

        return true;
    }
}

<?php declare(strict_types=1);

namespace GPCSV\Field;

use GPCSV\Field;
use GPCSV\Exception\UnsupportedFieldException;

class Unsupported extends Field
{
    public function validateValue(string $value): bool
    {
        throw new UnsupportedFieldException($this->name . ' is not currently a supported field');
    }
}

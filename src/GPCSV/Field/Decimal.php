<?php

declare(strict_types=1);

namespace GPCSV\Field;

use GPCSV\Field;

class Decimal extends Field
{
    protected $validationInvalidErrorMessage = 'Value must be numeric/decimal';

    protected $validationRegex = '/^[0-9\.]+$/';
}

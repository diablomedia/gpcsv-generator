<?php

declare(strict_types=1);

namespace GPCSV\Field;

use GPCSV\Field;

class Receiver1 extends Field
{
    protected $validationInvalidErrorMessage = 'Value must begin with a single forward slash (/)';

    protected $validationRegex = '|^/|';
}

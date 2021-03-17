<?php

declare(strict_types=1);

namespace GPCSV\Field;

use GPCSV\Field;

class Receiver2 extends Field
{
    protected $validationInvalidErrorMessage = 'Value must begin with two forward slashes (//)';

    protected $validationRegex = '|^//|';
}

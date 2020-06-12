<?php declare(strict_types=1);

namespace GPCSV;

use GPCSV\Exception\UnknownOptionException;
use GPCSV\Exception\InvalidValueException;
use GPCSV\Exception\StringLengthException;

abstract class Field
{
    /** @var string */
    protected $name = '';

    /** @var string */
    protected $label = '';

    /** @var string */
    protected $validCharacterRegex = "|[^A-Za-z0-9/\-?:()\.,'+ ]|";

    /** @var string */
    protected $validationRegex = '/^[A-Za-z0-9].*[A-Za-z0-9\.]$/';

    /** @var string */
    protected $validationInvalidErrorMessage = 'Value must begin and end with alphanumeric characters';

    /** @var null|int */
    protected $minLength;

    /** @var null|int */
    protected $maxLength;

    /** @param array<string, int|string>|array<string, array<int, string>|string> $options */
    public function __construct(array $options)
    {
        foreach ($options as $option => $value) {
            if (!property_exists($this, $option)) {
                throw new UnknownOptionException('Option does not exist: ' . $option);
            };

            $this->{$option} = $value;
        }
    }

    public function cleanValue(string $value): string
    {
        $value = preg_replace($this->validCharacterRegex, '', trim($value));
        if (!is_string($value)) {
            return '';
        }

        return $value;
    }

    private function getFriendlyName(): string
    {
        return empty($this->label) ? $this->name : $this->label;
    }

    /** @return true */
    public function validateValue(string $value): bool
    {
        if (is_int($this->minLength) && strlen($value) < $this->minLength) {
            throw new StringLengthException(sprintf(
                '%s must be at least %d characters',
                $this->getFriendlyName(),
                $this->minLength
            ));
        }

        if (is_int($this->maxLength) && strlen($value) > $this->maxLength) {
            throw new StringLengthException(sprintf(
                '%s must be no more than %d characters',
                $this->getFriendlyName(),
                $this->maxLength
            ));
        }

        if (!preg_match($this->validationRegex, $value)) {
            throw new InvalidValueException($this->getFriendlyName() . ': ' . $this->validationInvalidErrorMessage);
        }

        return true;
    }
}

<?php

declare(strict_types=1);

namespace GPCSV\Tests\Field;

use GPCSV\Exception;
use GPCSV\Field;
use PHPUnit\Framework\TestCase;

class StandardFieldTest extends TestCase
{
    public function testStandardFieldCleansUnsupportedCharacters(): void
    {
        $field    = new Field\Standard(['name' => 'teststandard', 'maxLength' => 5]);
        $original = "|\\%$*Aa0/-?:().,'+ zZ";
        $cleaned  = "Aa0/-?:().,'+ zZ";
        $this->assertEquals($cleaned, $field->cleanValue($original));
    }

    public function testStandardFieldValidationFailsIfStringLengthIsGreaterThanMaximum(): void
    {
        $this->expectException(Exception\StringLengthException::class);
        $this->expectExceptionMessage('teststandard must be no more than 5 characters');

        $field = new Field\Standard(['name' => 'teststandard', 'maxLength' => 5]);
        $field->validateValue('123456');
    }

    public function testStandardFieldValidationFailsIfStringLengthIsLessThanMinimum(): void
    {
        $this->expectException(Exception\StringLengthException::class);
        $this->expectExceptionMessage('teststandard must be at least 2 characters');

        $field = new Field\Standard(['name' => 'teststandard', 'minLength' => 2]);
        $field->validateValue('1');
    }

    public function testStandardFieldValidationFailsWithNonAlphanumericPrefix(): void
    {
        $this->expectException(Exception\InvalidValueException::class);
        $this->expectExceptionMessage('teststandard: Value must begin and end with alphanumeric characters');

        $field = new Field\Standard(['name' => 'teststandard']);
        $field->validateValue('/teststring');
    }

    public function testStandardFieldValidationFailsWithNonAlphanumericSuffix(): void
    {
        $this->expectException(Exception\InvalidValueException::class);
        $this->expectExceptionMessage('teststandard: Value must begin and end with alphanumeric characters');

        $field = new Field\Standard(['name' => 'teststandard']);
        $field->validateValue('teststring/');
    }

    public function testStandardFieldValidationSucceedsIfStringLengthIsWithinMinimumAndMaximumRange(): void
    {
        $field = new Field\Standard(['name' => 'teststandard', 'minLength' => 2, 'maxLength' => 2]);
        $this->assertTrue($field->validateValue('12'));
    }

    public function testStandardFieldValidationSucceedsWithAlphanumericWrappingAllSupportedCharacters(): void
    {
        $field = new Field\Standard(['name' => 'teststandard']);
        $this->assertTrue($field->validateValue("Aa0/-?:().,'+ zZ"));
    }
}

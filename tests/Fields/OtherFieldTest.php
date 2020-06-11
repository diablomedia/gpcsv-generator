<?php declare(strict_types=1);

namespace GPCSV\Tests\Field;

use PHPUnit\Framework\TestCase;
use GPCSV\Field;
use GPCSV\Exception;

class OtherFieldTest extends TestCase
{
    public function testDecimalFieldFailsWithNonNumericValue(): void
    {
        $this->expectException(Exception\InvalidValueException::class);
        $this->expectExceptionMessage('testdecimal: Value must be numeric/decimal');

        $field = new Field\Decimal(['name' => 'testdecimal']);
        $field->validateValue('alpha');
    }

    public function testDecimalFieldValidationSucceedsWithNumericValue(): void
    {
        $field = new Field\Decimal(['name' => 'testdecimal']);
        $this->assertTrue($field->validateValue('12'));
    }

    public function testDecimalFieldValidationSucceedsWithDecimalValue(): void
    {
        $field = new Field\Decimal(['name' => 'testdecimal']);
        $this->assertTrue($field->validateValue('12.34'));
    }

    public function testNumericFieldFailsWithNonNumericValue(): void
    {
        $this->expectException(Exception\InvalidValueException::class);
        $this->expectExceptionMessage('testnumeric: Value must be digits only');

        $field = new Field\Numeric(['name' => 'testnumeric']);
        $field->validateValue('alpha');
    }

    public function testNumericFieldValidationFailsWithDecimalValue(): void
    {
        $this->expectException(Exception\InvalidValueException::class);
        $this->expectExceptionMessage('testnumeric: Value must be digits only');

        $field = new Field\Numeric(['name' => 'testnumeric']);
        $field->validateValue('12.34');
    }

    public function testNumericFieldValidationSucceedsWithNumericValue(): void
    {
        $field = new Field\Numeric(['name' => 'testnumeric']);
        $this->assertTrue($field->validateValue('12'));
    }

    public function testEmailFieldValidationFailsWithNonEmailValue(): void
    {
        $this->expectException(Exception\InvalidValueException::class);
        $this->expectExceptionMessage('testemail must be in valid email address format');

        $field = new Field\Email(['name' => 'testemail']);
        $field->validateValue('teststring');
    }

    public function testEmailFieldValidationSucceedsWithEmailValue(): void
    {
        $field = new Field\Email(['name' => 'testemail']);
        $this->assertTrue($field->validateValue('test@test.com'));
    }

    public function testReceiver1FieldValidationFailsWithoutSlashPrefix(): void
    {
        $this->expectException(Exception\InvalidValueException::class);
        $this->expectExceptionMessage('testreceiver1: Value must begin with a single forward slash (/)');

        $field = new Field\Receiver1(['name' => 'testreceiver1']);
        $field->validateValue('teststring');
    }

    public function testReceiver1FieldValidationSucceedsWithSlashPrefix(): void
    {
        $field = new Field\Receiver1(['name' => 'testreceiver1']);
        $this->assertTrue($field->validateValue('/teststring'));
    }

    public function testReceiver2FieldValidationFailsWithoutSlashPrefix(): void
    {
        $this->expectException(Exception\InvalidValueException::class);
        $this->expectExceptionMessage('testreceiver2: Value must begin with two forward slashes (//)');

        $field = new Field\Receiver2(['name' => 'testreceiver2']);
        $field->validateValue('teststring');
    }
    
    public function testReceiver2FieldValidationFailsWithSingleSlashPrefix(): void
    {
        $this->expectException(Exception\InvalidValueException::class);
        $this->expectExceptionMessage('testreceiver2: Value must begin with two forward slashes (//)');

        $field = new Field\Receiver2(['name' => 'testreceiver2']);
        $field->validateValue('/teststring');
    }

    public function testReceiver2FieldValidationSucceedsWithDoubleSlashPrefix(): void
    {
        $field = new Field\Receiver2(['name' => 'testreceiver2']);
        $this->assertTrue($field->validateValue('//teststring'));
    }

    public function testUnsupportedFieldValidationAlwaysFails(): void
    {
        $this->expectException(Exception\UnsupportedFieldException::class);
        $this->expectExceptionMessage('testunsupported is not currently a supported field');

        $field = new Field\Unsupported(['name' => 'testunsupported']);
        $field->validateValue('teststring');
    }

    public function testValueListFieldValidationFailsIfValueNotInList(): void
    {
        $this->expectException(Exception\InvalidValueException::class);
        $this->expectExceptionMessage('testvaluelist must be one of: valid1, valid2');

        $field = new Field\ValueList(['name' => 'testvaluelist', 'values' => ['valid1', 'valid2']]);
        $field->validateValue('invalid');
    }

    public function testValueListFieldValidationSucceedsIfValueIsInList(): void
    {
        $field = new Field\ValueList(['name' => 'testvaluelist', 'values' => ['valid1', 'valid2']]);
        $this->assertTrue($field->validateValue('valid1'));
    }
}

<?php declare(strict_types=1);

namespace GPCSV;

use GPCSV\Field;

class FieldFactory
{
    // If not specified here, the Standard field type will be used
    // note that this also dictates the order of fields in CSV body
    /** @var array<string, array<string, array<int, string>|int|string>> */
    public static $fieldDefinitions = [
        'destinationCountry'          => ['class' => Field\Standard::class, 'minLength' => 2, 'maxLength' => 2],
        'paymentType'                 => ['class' => Field\ValueList::class, 'values' => ['AT', 'DD', 'LOW', 'MT210', 'URG']],
        'sendersReference'            => ['class' => Field\Standard::class, 'minLength' => 1, 'maxLength' => 16],
        'relatedReference'            => ['class' => Field\Standard::class, 'minLength' => 1, 'maxLength' => 16],
        'valueDate'                   => ['class' => Field\Numeric::class, 'minLength' => 10, 'maxLength' => 10],
        'debitAccountNumber'          => ['class' => Field\Standard::class],
        'debitAmount'                 => ['class' => Field\Decimal::class],
        'creditAmount'                => ['class' => Field\Decimal::class],
        'currency'                    => ['class' => Field\Standard::class, 'minLength' => 3, 'maxLength' => 3],
        'draweeCountry'               => ['class' => Field\Standard::class, 'minLength' => 2, 'maxLength' => 2],
        'originatorName'              => ['class' => Field\Standard::class],
        'originatorAccount'           => ['class' => Field\Standard::class],
        'originatorAddress'           => ['class' => Field\Standard::class],
        'originatorCity'              => ['class' => Field\Standard::class],
        'originatorCountry'           => ['class' => Field\Standard::class],
        'beneficiaryAccount'          => ['class' => Field\Standard::class],
        'beneficiaryName'             => ['class' => Field\Standard::class],
        'beneficiaryAddress'          => ['class' => Field\Standard::class],
        'beneficiaryCity'             => ['class' => Field\Standard::class],
        'beneficiaryPostalCode'       => ['class' => Field\Standard::class],
        'beneficiaryCountry'          => ['class' => Field\Standard::class, 'minLength' => 2, 'maxLength' => 2],
        'beneficiaryBankID'           => ['class' => Field\Standard::class],
        'beneficiaryInformationLine1' => ['class' => Field\Standard::class],
        'beneficiaryInformationLine2' => ['class' => Field\Standard::class],
        'beneficiaryInformationLine3' => ['class' => Field\Standard::class],
        'beneficiaryInformationLine4' => ['class' => Field\Standard::class],
        'intermediaryBankID'          => ['class' => Field\Standard::class],
        'receivingBankID'             => ['class' => Field\Unsupported::class],
        'receiverInformationLine1'    => ['class' => Field\Receiver1::class],
        'receiverInformationLine2'    => ['class' => Field\Receiver2::class],
        'receiverInformationLine3'    => ['class' => Field\Receiver2::class],
        'receiverInformationLine4'    => ['class' => Field\Receiver2::class],
        'beneficiaryEmail'            => ['class' => Field\Email::class],
        'notes'                       => ['class' => Field\Standard::class],
        'sendNoteToBeneficiary'       => ['class' => Field\Numeric::class],
        'charges'                     => ['class' => Field\ValueList::class, 'values' => ['SHA', 'OUR', 'BEN']],
        'userDefinedField1'           => ['class' => Field\Standard::class],
        'userDefinedField2'           => ['class' => Field\Standard::class],
        'userDefinedField3'           => ['class' => Field\Standard::class],
        'userDefinedField4'           => ['class' => Field\Standard::class],
        'userDefinedField5'           => ['class' => Field\Standard::class],
        'templateCode'                => ['class' => Field\Standard::class],
        'templateName'                => ['class' => Field\Standard::class],
        'reserved'                    => ['class' => Field\Unsupported::class],
        'purposeOfPayment'            => ['class' => Field\Standard::class],
        'beneficiaryAdvising'         => ['class' => Field\Standard::class],
        'systemField1'                => ['class' => Field\Standard::class],
        'systemField2'                => ['class' => Field\Standard::class],
        'systemField3'                => ['class' => Field\Standard::class],
        'systemField4'                => ['class' => Field\Standard::class],
        'systemField5'                => ['class' => Field\Standard::class],
        'systemField6'                => ['class' => Field\Standard::class],
        'systemField7'                => ['class' => Field\Standard::class],
        'systemField8'                => ['class' => Field\Standard::class],
        'systemField9'                => ['class' => Field\Standard::class],
        'systemField10'               => ['class' => Field\Standard::class],
        'systemField11'               => ['class' => Field\Standard::class],
        'systemField12'               => ['class' => Field\Standard::class],
        'systemField13'               => ['class' => Field\Standard::class],
        'systemField14'               => ['class' => Field\Standard::class],
        'systemField15'               => ['class' => Field\Standard::class],
        'systemField16'               => ['class' => Field\Standard::class],
        'systemField17'               => ['class' => Field\Standard::class],
        'systemField18'               => ['class' => Field\Standard::class],
        'systemField19'               => ['class' => Field\Standard::class],
        'systemField20'               => ['class' => Field\Standard::class],
    ];

    public static function createField(string $name): Field
    {
        if (!isset(self::$fieldDefinitions[$name])) {
            throw new Exception('Invalid field: ' . $name);
        }

        $definition = self::$fieldDefinitions[$name];
        $class      = $definition['class'];

        $field = new $class(array_diff_key($definition, ['class' => $class]));

        if (!($field instanceof Field)) {
            throw new Exception('Class could not be instantiated: ' . $class);
        }

        return $field;
    }
}

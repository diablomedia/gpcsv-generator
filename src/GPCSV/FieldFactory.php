<?php

declare(strict_types=1);

namespace GPCSV;

class FieldFactory
{
    // If not specified here, the Standard field type will be used

    /** @var array<string, array<string, array<int, string>|int|string>> */
    public static $fieldDefinitions = [
        'destinationCountry'          => ['class' => Field\Standard::class, 'label' => 'Destination Country', 'minLength' => 2, 'maxLength' => 2],
        'paymentType'                 => ['class' => Field\ValueList::class, 'label' => 'Payment Type', 'values' => ['AT', 'DD', 'LOW', 'MT210', 'URG']],
        'sendersReference'            => ['class' => Field\Standard::class, 'label' => 'Sender\'s Reference' ,'minLength' => 1, 'maxLength' => 16],
        'relatedReference'            => ['class' => Field\Standard::class, 'label' => 'Related Reference' ,'minLength' => 1, 'maxLength' => 16],
        'valueDate'                   => ['class' => Field\Numeric::class, 'label' => 'Value Date' ,'minLength' => 8, 'maxLength' => 8],
        'debitAccountNumber'          => ['class' => Field\Standard::class, 'label' => 'Debit Account Number'],
        'debitAmount'                 => ['class' => Field\Decimal::class, 'label' => 'Debit Amount'],
        'creditAmount'                => ['class' => Field\Decimal::class, 'label' => 'Credit Amount'],
        'currency'                    => ['class' => Field\Standard::class, 'label' => 'Currency' ,'minLength' => 3, 'maxLength' => 3],
        'draweeCountry'               => ['class' => Field\Standard::class, 'label' => 'Drawee Country' ,'minLength' => 2, 'maxLength' => 2],
        'originatorName'              => ['class' => Field\Standard::class, 'label' => 'Originator Name'],
        'originatorAccount'           => ['class' => Field\Standard::class, 'label' => 'Originator Account'],
        'originatorAddress'           => ['class' => Field\Standard::class, 'label' => 'Originator Address'],
        'originatorCity'              => ['class' => Field\Standard::class, 'label' => 'Originator City'],
        'originatorCountry'           => ['class' => Field\Standard::class, 'label' => 'Originator Country'],
        'beneficiaryAccount'          => ['class' => Field\Standard::class, 'label' => 'Beneficiary Account'],
        'beneficiaryName'             => ['class' => Field\Standard::class, 'label' => 'Beneficiary Name'],
        'beneficiaryAddress'          => ['class' => Field\Standard::class, 'label' => 'Beneficiary Address'],
        'beneficiaryCity'             => ['class' => Field\Standard::class, 'label' => 'Beneficiary City'],
        'beneficiaryPostalCode'       => ['class' => Field\Standard::class, 'label' => 'Beneficiary Postal Code'],
        'beneficiaryCountry'          => ['class' => Field\Standard::class, 'label' => 'Beneficiary Country' ,'minLength' => 2, 'maxLength' => 2],
        'beneficiaryBankID'           => ['class' => Field\Standard::class, 'label' => 'Beneficiary Bank ID'],
        'beneficiaryInformationLine1' => ['class' => Field\Standard::class, 'label' => 'Beneficiary Information Line 1'],
        'beneficiaryInformationLine2' => ['class' => Field\Standard::class, 'label' => 'Beneficiary Information Line 2'],
        'beneficiaryInformationLine3' => ['class' => Field\Standard::class, 'label' => 'Beneficiary Information Line 3'],
        'beneficiaryInformationLine4' => ['class' => Field\Standard::class, 'label' => 'Beneficiary Information Line 4'],
        'intermediaryBankID'          => ['class' => Field\Standard::class, 'label' => 'Intermediary Bank ID'],
        'receivingBankID'             => ['class' => Field\Unsupported::class, 'label' => 'Receiving Bank ID'],
        'receiverInformationLine1'    => ['class' => Field\Receiver1::class, 'label' => 'Receiver Information Line 1'],
        'receiverInformationLine2'    => ['class' => Field\Receiver2::class, 'label' => 'Receiver Information Line 2'],
        'receiverInformationLine3'    => ['class' => Field\Receiver2::class, 'label' => 'Receiver Information Line 3'],
        'receiverInformationLine4'    => ['class' => Field\Receiver2::class, 'label' => 'Receiver Information Line 4'],
        'beneficiaryEmail'            => ['class' => Field\Email::class, 'label' => 'Beneficiary Email'],
        'notes'                       => ['class' => Field\Standard::class, 'label' => 'Notes'],
        'sendNoteToBeneficiary'       => ['class' => Field\Numeric::class, 'label' => 'Send Note to Beneficiary'],
        'charges'                     => ['class' => Field\ValueList::class, 'label' => 'Charges' ,'values' => ['SHA', 'OUR', 'BEN']],
        'userDefinedField1'           => ['class' => Field\Standard::class, 'label' => 'User Defined Field 1'],
        'userDefinedField2'           => ['class' => Field\Standard::class, 'label' => 'User Defined Field 2'],
        'userDefinedField3'           => ['class' => Field\Standard::class, 'label' => 'User Defined Field 3'],
        'userDefinedField4'           => ['class' => Field\Standard::class, 'label' => 'User Defined Field 4'],
        'userDefinedField5'           => ['class' => Field\Standard::class, 'label' => 'User Defined Field 5'],
        'templateCode'                => ['class' => Field\Standard::class, 'label' => 'Template Code'],
        'templateName'                => ['class' => Field\Standard::class, 'label' => 'Template Name'],
        'reserved'                    => ['class' => Field\Unsupported::class, 'label' => 'Reserved'],
        'purposeOfPayment'            => ['class' => Field\Standard::class, 'label' => 'Purpose of Payment'],
        'beneficiaryAdvising'         => ['class' => Field\Standard::class, 'label' => 'Beneficiary Advising'],
        'systemField1'                => ['class' => Field\Standard::class, 'label' => 'System Field 1'],
        'systemField2'                => ['class' => Field\Standard::class, 'label' => 'System Field 2'],
        'systemField3'                => ['class' => Field\Standard::class, 'label' => 'System Field 3'],
        'systemField4'                => ['class' => Field\Standard::class, 'label' => 'System Field 4'],
        'systemField5'                => ['class' => Field\Standard::class, 'label' => 'System Field 5'],
        'systemField6'                => ['class' => Field\Standard::class, 'label' => 'System Field 6'],
        'systemField7'                => ['class' => Field\Standard::class, 'label' => 'System Field 7'],
        'systemField8'                => ['class' => Field\Standard::class, 'label' => 'System Field 8'],
        'systemField9'                => ['class' => Field\Standard::class, 'label' => 'System Field 9'],
        'systemField10'               => ['class' => Field\Standard::class, 'label' => 'System Field 10'],
        'systemField11'               => ['class' => Field\Standard::class, 'label' => 'System Field 11'],
        'systemField12'               => ['class' => Field\Standard::class, 'label' => 'System Field 12'],
        'systemField13'               => ['class' => Field\Standard::class, 'label' => 'System Field 13'],
        'systemField14'               => ['class' => Field\Standard::class, 'label' => 'System Field 14'],
        'systemField15'               => ['class' => Field\Standard::class, 'label' => 'System Field 15'],
        'systemField16'               => ['class' => Field\Standard::class, 'label' => 'System Field 16'],
        'systemField17'               => ['class' => Field\Standard::class, 'label' => 'System Field 17'],
        'systemField18'               => ['class' => Field\Standard::class, 'label' => 'System Field 18'],
        'systemField19'               => ['class' => Field\Standard::class, 'label' => 'System Field 19'],
        'systemField20'               => ['class' => Field\Standard::class, 'label' => 'System Field 20'],
    ];

    public static function createField(string $name): Field
    {
        if (!isset(self::$fieldDefinitions[$name])) {
            throw new Exception('Invalid field: ' . $name);
        }

        $definition = self::$fieldDefinitions[$name];
        $class      = $definition['class'];
        assert(is_string($class));

        $field = new $class(['name' => $name] + array_diff_key($definition, ['class' => $class]));

        if (!($field instanceof Field)) {
            throw new Exception('Class could not be instantiated: ' . $class);
        }

        return $field;
    }
}

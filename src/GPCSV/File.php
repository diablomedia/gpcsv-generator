<?php declare(strict_types=1);

namespace GPCSV;

use GPCSV\Exception\UnknownOptionException;
use GPCSV\Exception\RequiredFieldException;

class File
{
    /**
     * Fields flagged as mandatory in all cases. Conditionally-required fields are not currently evaluated
     * @var array<string>
     */
    private $requiredFields = [
        'destinationCountry',
        'paymentType',
        'debitAccountNumber',
        'currency',
        'beneficiaryName',
        'beneficiaryAddress',
        'beneficiaryCity',
        'beneficiaryCountry'
    ];

    /** @var array<string> */
    private $fieldOrder = [
        'destinationCountry',
        'paymentType',
        'sendersReference',
        'relatedReference',
        'valueDate',
        'debitAccountNumber',
        'debitAmount',
        'creditAmount',
        'currency',
        'draweeCountry',
        'originatorName',
        'originatorAccount',
        'originatorAddress',
        'originatorCity',
        'originatorCountry',
        'beneficiaryAccount',
        'beneficiaryName',
        'beneficiaryAddress',
        'beneficiaryCity',
        'beneficiaryPostalCode',
        'beneficiaryCountry',
        'beneficiaryBankID',
        'beneficiaryInformationLine1',
        'beneficiaryInformationLine2',
        'beneficiaryInformationLine3',
        'beneficiaryInformationLine4',
        'intermediaryBankID',
        'receivingBankID',
        'receiverInformationLine1',
        'receiverInformationLine2',
        'receiverInformationLine3',
        'receiverInformationLine4',
        'beneficiaryEmail',
        'notes',
        'sendNoteToBeneficiary',
        'charges',
        'userDefinedField1',
        'userDefinedField2',
        'userDefinedField3',
        'userDefinedField4',
        'userDefinedField5',
        'templateCode',
        'templateName',
        'reserved',
        'purposeOfPayment',
        'beneficiaryAdvising',
        'systemField1',
        'systemField2',
        'systemField3',
        'systemField4',
        'systemField5',
        'systemField6',
        'systemField7',
        'systemField8',
        'systemField9',
        'systemField10',
        'systemField11',
        'systemField12',
        'systemField13',
        'systemField14',
        'systemField15',
        'systemField16',
        'systemField17',
        'systemField18',
        'systemField19',
        'systemField20',
    ];

    /** @var bool */
    protected $autoClean = true;

    /** @var string */
    protected $destinationCountry = '';

    /** @var string */
    protected $paymentType = '';

    /** @var string */
    protected $sendersReference = '';

    /** @var string */
    protected $relatedReference = '';

    /** @var string */
    protected $valueDate = '';

    /** @var string */
    protected $debitAccountNumber = '';

    /** @var string */
    protected $debitAmount = '';

    /** @var string */
    protected $creditAmount = '';

    /** @var string */
    protected $currency = '';

    /** @var string */
    protected $draweeCountry = '';

    /** @var string */
    protected $originatorName = '';

    /** @var string */
    protected $originatorAccount = '';

    /** @var string */
    protected $originatorAddress = '';

    /** @var string */
    protected $originatorCity = '';

    /** @var string */
    protected $originatorCountry = '';

    /** @var string */
    protected $beneficiaryAccount = '';

    /** @var string */
    protected $beneficiaryName = '';

    /** @var string */
    protected $beneficiaryAddress = '';

    /** @var string */
    protected $beneficiaryCity = '';

    /** @var string */
    protected $beneficiaryPostalCode = '';

    /** @var string */
    protected $beneficiaryCountry = '';

    /** @var string */
    protected $beneficiaryBankID = '';

    /** @var string */
    protected $beneficiaryInformationLine1 = '';

    /** @var string */
    protected $beneficiaryInformationLine2 = '';

    /** @var string */
    protected $beneficiaryInformationLine3 = '';

    /** @var string */
    protected $beneficiaryInformationLine4 = '';

    /** @var string */
    protected $intermediaryBankID = '';

    /** @var string */
    protected $receivingBankID = '';

    /** @var string */
    protected $receiverInformationLine1 = '';

    /** @var string */
    protected $receiverInformationLine2 = '';

    /** @var string */
    protected $receiverInformationLine3 = '';

    /** @var string */
    protected $receiverInformationLine4 = '';

    /** @var string */
    protected $beneficiaryEmail = '';

    /** @var string */
    protected $notes = '';

    /** @var string */
    protected $sendNoteToBeneficiary = '';

    /** @var string */
    protected $charges = '';

    /** @var string */
    protected $userDefinedField1 = '';

    /** @var string */
    protected $userDefinedField2 = '';

    /** @var string */
    protected $userDefinedField3 = '';

    /** @var string */
    protected $userDefinedField4 = '';

    /** @var string */
    protected $userDefinedField5 = '';

    /** @var string */
    protected $templateCode = '';

    /** @var string */
    protected $templateName = '';

    /** @var string */
    protected $reserved = '';

    /** @var string */
    protected $purposeOfPayment = '';

    /** @var string */
    protected $beneficiaryAdvising = '';

    /** @var string */
    protected $systemField1 = '';

    /** @var string */
    protected $systemField2 = '';

    /** @var string */
    protected $systemField3 = '';

    /** @var string */
    protected $systemField4 = '';

    /** @var string */
    protected $systemField5 = '';

    /** @var string */
    protected $systemField6 = '';

    /** @var string */
    protected $systemField7 = '';

    /** @var string */
    protected $systemField8 = '';

    /** @var string */
    protected $systemField9 = '';

    /** @var string */
    protected $systemField10 = '';

    /** @var string */
    protected $systemField11 = '';

    /** @var string */
    protected $systemField12 = '';

    /** @var string */
    protected $systemField13 = '';

    /** @var string */
    protected $systemField14 = '';

    /** @var string */
    protected $systemField15 = '';

    /** @var string */
    protected $systemField16 = '';

    /** @var string */
    protected $systemField17 = '';

    /** @var string */
    protected $systemField18 = '';

    /** @var string */
    protected $systemField19 = '';

    /** @var string */
    protected $systemField20 = '';

    /** @param array<bool> $options */
    public function __construct(array $options)
    {
        if (isset($options['autoClean'])) {
            $this->setOptionAutomaticallyCleanFields($options['autoClean']);
            unset($options['autoClean']);
        }

        if (!empty($options)) {
            throw new UnknownOptionException('Unknown option provided: ' . array_keys($options)[0]);
        }
    }

    public function setOptionAutomaticallyCleanFields(bool $autoClean): void
    {
        $this->autoClean = $autoClean;
    }

    private function cleanAndValidate(Field $field, string $value): string
    {
        if ($this->autoClean === true) {
            $value = $field->cleanValue($value);
        }

        $field->validateValue($value);

        return $value;
    }

    public function setDestinationCountry(string $val): void
    {
        $field = FieldFactory::createField('destinationCountry');

        $this->destinationCountry = $this->cleanAndValidate($field, $val);
    }

    public function setPaymentType(string $val): void
    {
        $field = FieldFactory::createField('paymentType');

        $this->paymentType = $this->cleanAndValidate($field, $val);
    }

    public function setSendersReference(string $val): void
    {
        $field = FieldFactory::createField('sendersReference');

        $this->sendersReference = $this->cleanAndValidate($field, $val);
    }

    public function setRelatedReference(string $val): void
    {
        $field = FieldFactory::createField('relatedReference');

        $this->relatedReference = $this->cleanAndValidate($field, $val);
    }
    
    public function setValueDate(string $val): void
    {
        $field = FieldFactory::createField('valueDate');

        $this->valueDate = $this->cleanAndValidate($field, $val);
    }

    public function setDebitAccountNumber(string $val): void
    {
        $field = FieldFactory::createField('debitAccountNumber');

        $this->debitAccountNumber = $this->cleanAndValidate($field, $val);
    }

    public function setDebitAmount(string $val): void
    {
        $field = FieldFactory::createField('debitAmount');

        $this->debitAmount = $this->cleanAndValidate($field, $val);
    }

    public function setCreditAmount(string $val): void
    {
        $field = FieldFactory::createField('creditAmount');

        $this->creditAmount = $this->cleanAndValidate($field, $val);
    }

    public function setCurrency(string $val): void
    {
        $field = FieldFactory::createField('currency');

        $this->currency = $this->cleanAndValidate($field, $val);
    }

    public function setDraweeCountry(string $val): void
    {
        $field = FieldFactory::createField('draweeCountry');

        $this->draweeCountry = $this->cleanAndValidate($field, $val);
    }

    public function setOriginatorName(string $val): void
    {
        $field = FieldFactory::createField('originatorName');

        $this->originatorName = $this->cleanAndValidate($field, $val);
    }

    public function setOriginatorAccount(string $val): void
    {
        $field = FieldFactory::createField('originatorAccount');

        $this->originatorAccount = $this->cleanAndValidate($field, $val);
    }

    public function setOriginatorAddress(string $val): void
    {
        $field = FieldFactory::createField('originatorAddress');

        $this->originatorAddress = $this->cleanAndValidate($field, $val);
    }
    
    public function setOriginatorCity(string $val): void
    {
        $field = FieldFactory::createField('originatorCity');

        $this->originatorCity = $this->cleanAndValidate($field, $val);
    }

    public function setOriginatorCountry(string $val): void
    {
        $field = FieldFactory::createField('originatorCountry');

        $this->originatorCountry = $this->cleanAndValidate($field, $val);
    }

    public function setBeneficiaryAccount(string $val): void
    {
        $field = FieldFactory::createField('beneficiaryAccount');

        $this->beneficiaryAccount = $this->cleanAndValidate($field, $val);
    }

    public function setBeneficiaryName(string $val): void
    {
        $field = FieldFactory::createField('beneficiaryName');

        $this->beneficiaryName = $this->cleanAndValidate($field, $val);
    }

    public function setBeneficiaryAddress(string $val): void
    {
        $field = FieldFactory::createField('beneficiaryAddress');

        $this->beneficiaryAddress = $this->cleanAndValidate($field, $val);
    }
    public function setBeneficiaryCity(string $val): void
    {
        $field = FieldFactory::createField('beneficiaryCity');

        $this->beneficiaryCity = $this->cleanAndValidate($field, $val);
    }
    public function setBeneficiaryPostalCode(string $val): void
    {
        $field = FieldFactory::createField('beneficiaryPostalCode');

        $this->beneficiaryPostalCode = $this->cleanAndValidate($field, $val);
    }
    public function setBeneficiaryCountry(string $val): void
    {
        $field = FieldFactory::createField('beneficiaryCountry');

        $this->beneficiaryCountry = $this->cleanAndValidate($field, $val);
    }
    public function setBeneficiaryBankID(string $val): void
    {
        $field = FieldFactory::createField('beneficiaryBankID');

        $this->beneficiaryBankID = $this->cleanAndValidate($field, $val);
    }
    public function setBeneficiaryInformationLine1(string $val): void
    {
        $field = FieldFactory::createField('beneficiaryInformationLine1');

        $this->beneficiaryInformationLine1 = $this->cleanAndValidate($field, $val);
    }
    public function setBeneficiaryInformationLine2(string $val): void
    {
        $field = FieldFactory::createField('beneficiaryInformationLine2');

        $this->beneficiaryInformationLine2 = $this->cleanAndValidate($field, $val);
    }
    public function setBeneficiaryInformationLine3(string $val): void
    {
        $field = FieldFactory::createField('beneficiaryInformationLine3');

        $this->beneficiaryInformationLine3 = $this->cleanAndValidate($field, $val);
    }
    public function setBeneficiaryInformationLine4(string $val): void
    {
        $field = FieldFactory::createField('beneficiaryInformationLine4');

        $this->beneficiaryInformationLine4 = $this->cleanAndValidate($field, $val);
    }
    public function setIntermediaryBankID(string $val): void
    {
        $field = FieldFactory::createField('IntermediaryBankID');

        $this->intermediaryBankID = $this->cleanAndValidate($field, $val);
    }
    public function setReceivingBankID(string $val): void
    {
        $field = FieldFactory::createField('receivingBankID');

        $this->receivingBankID = $this->cleanAndValidate($field, $val);
    }
    public function setReceiverInformationLine1(string $val): void
    {
        $field = FieldFactory::createField('receiverInformationLine1');

        $this->receiverInformationLine1 = $this->cleanAndValidate($field, $val);
    }
    public function setReceiverInformationLine2(string $val): void
    {
        $field = FieldFactory::createField('receiverInformationLine2');

        $this->receiverInformationLine2 = $this->cleanAndValidate($field, $val);
    }
    public function setReceiverInformationLine3(string $val): void
    {
        $field = FieldFactory::createField('receiverInformationLine3');

        $this->receiverInformationLine3 = $this->cleanAndValidate($field, $val);
    }
    public function setReceiverInformationLine4(string $val): void
    {
        $field = FieldFactory::createField('receiverInformationLine4');

        $this->receiverInformationLine4 = $this->cleanAndValidate($field, $val);
    }
    public function setBeneficiaryEmail(string $val): void
    {
        $field = FieldFactory::createField('beneficiaryEmail');

        $this->beneficiaryEmail = $this->cleanAndValidate($field, $val);
    }
    public function setNotes(string $val): void
    {
        $field = FieldFactory::createField('notes');

        $this->notes = $this->cleanAndValidate($field, $val);
    }
    public function setSendNoteToBeneficiary(string $val): void
    {
        $field = FieldFactory::createField('sendNoteToBeneficiary');

        $this->sendNoteToBeneficiary = $this->cleanAndValidate($field, $val);
    }
    public function setCharges(string $val): void
    {
        $field = FieldFactory::createField('charges');

        $this->charges = $this->cleanAndValidate($field, $val);
    }
    public function setUserDefinedField1(string $val): void
    {
        $field = FieldFactory::createField('userDefinedField1');

        $this->userDefinedField1 = $this->cleanAndValidate($field, $val);
    }
    public function setUserDefinedField2(string $val): void
    {
        $field = FieldFactory::createField('userDefinedField2');

        $this->userDefinedField2 = $this->cleanAndValidate($field, $val);
    }
    public function setUserDefinedField3(string $val): void
    {
        $field = FieldFactory::createField('userDefinedField3');

        $this->userDefinedField3 = $this->cleanAndValidate($field, $val);
    }
    public function setUserDefinedField4(string $val): void
    {
        $field = FieldFactory::createField('userDefinedField4');

        $this->userDefinedField4 = $this->cleanAndValidate($field, $val);
    }
    public function setUserDefinedField5(string $val): void
    {
        $field = FieldFactory::createField('userDefinedField5');

        $this->userDefinedField5 = $this->cleanAndValidate($field, $val);
    }
    public function setTemplateCode(string $val): void
    {
        $field = FieldFactory::createField('tmeplateCode');

        $this->templateCode = $this->cleanAndValidate($field, $val);
    }
    public function setTemplateName(string $val): void
    {
        $field = FieldFactory::createField('templateName');

        $this->templateName = $this->cleanAndValidate($field, $val);
    }
    public function setReserved(string $val): void
    {
        $field = FieldFactory::createField('reserved');

        $this->reserved = $this->cleanAndValidate($field, $val);
    }
    public function setPurposeOfPayment(string $val): void
    {
        $field = FieldFactory::createField('purposeOfPayment');

        $this->purposeOfPayment = $this->cleanAndValidate($field, $val);
    }
    public function setBeneficiaryAdvising(string $val): void
    {
        $field = FieldFactory::createField('beneficiaryAdvising');

        $this->beneficiaryAdvising = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField1(string $val): void
    {
        $field = FieldFactory::createField('systemField1');

        $this->systemField1 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField2(string $val): void
    {
        $field = FieldFactory::createField('systemField2');

        $this->systemField2 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField3(string $val): void
    {
        $field = FieldFactory::createField('systemField3');

        $this->systemField3 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField4(string $val): void
    {
        $field = FieldFactory::createField('systemField4');

        $this->systemField4 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField5(string $val): void
    {
        $field = FieldFactory::createField('systemField5');

        $this->systemField5 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField6(string $val): void
    {
        $field = FieldFactory::createField('systemField6');

        $this->systemField6 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField7(string $val): void
    {
        $field = FieldFactory::createField('systemField7');

        $this->systemField7 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField8(string $val): void
    {
        $field = FieldFactory::createField('systemField8');

        $this->systemField8 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField9(string $val): void
    {
        $field = FieldFactory::createField('systemField9');

        $this->systemField9 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField10(string $val): void
    {
        $field = FieldFactory::createField('systemField10');

        $this->systemField10 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField11(string $val): void
    {
        $field = FieldFactory::createField('systemField11');

        $this->systemField11 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField12(string $val): void
    {
        $field = FieldFactory::createField('systemField12');

        $this->systemField12 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField13(string $val): void
    {
        $field = FieldFactory::createField('systemField13');

        $this->systemField13 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField14(string $val): void
    {
        $field = FieldFactory::createField('systemField14');

        $this->systemField14 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField15(string $val): void
    {
        $field = FieldFactory::createField('systemField15');

        $this->systemField15 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField16(string $val): void
    {
        $field = FieldFactory::createField('systemField16');

        $this->systemField16 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField17(string $val): void
    {
        $field = FieldFactory::createField('systemField17');

        $this->systemField17 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField18(string $val): void
    {
        $field = FieldFactory::createField('systemField18');

        $this->systemField18 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField19(string $val): void
    {
        $field = FieldFactory::createField('systemField19');

        $this->systemField19 = $this->cleanAndValidate($field, $val);
    }
    public function setSystemField20(string $val): void
    {
        $field = FieldFactory::createField('systemField20');

        $this->systemField20 = $this->cleanAndValidate($field, $val);
    }

    private function validateRequiredFields(): void
    {
        foreach ($this->requiredFields as $field) {
            if ($field === '') {
                throw new RequiredFieldException($field . ' is required');
            }
        }
    }
    public function __toString(): string
    {
        $this->validateRequiredFields();

        $csvString = '';
        foreach ($this->fieldOrder as $field) {
            $csvString .= $this->{$field} . ',';
        }
        $csvString = substr($csvString, -1); // trim trailing comma

        return $csvString;
    }
}

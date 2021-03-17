<?php

declare(strict_types=1);

namespace GPCSV\Tests;

use GPCSV\Exception;
use GPCSV\Exception\RequiredFieldException;
use GPCSV\Payment;
use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    public function testCsvOutputWithAllSupportedFields(): void
    {
        $payment = new Payment([]);
        $payment->setDestinationCountry('US');
        $payment->setPaymentType('URG');
        $payment->setSendersReference('senderref');
        $payment->setRelatedReference('relatedref');
        $payment->setValueDate('01012020');
        $payment->setDebitAccountNumber('debitacct');
        $payment->setDebitAmount('123.45');
        $payment->setCreditAmount('456.78');
        $payment->setCurrency('USD');
        $payment->setDraweeCountry('GB');
        $payment->setOriginatorName('Originator Name');
        $payment->setOriginatorAccount('Originator Acct');
        $payment->setOriginatorAddress('Originator Address');
        $payment->setOriginatorCity('Originator City');
        $payment->setOriginatorCountry('GB');
        $payment->setBeneficiaryAccount('Beneficiary Account');
        $payment->setBeneficiaryName('Beneficiary Name');
        $payment->setBeneficiaryAddress('Beneficiary Address');
        $payment->setBeneficiaryCity('Beneficiary City');
        $payment->setBeneficiaryPostalCode('Beneficiary Postal Code');
        $payment->setBeneficiaryCountry('UK');
        $payment->setBeneficiaryBankID('Beneficiary Bank ID');
        $payment->setBeneficiaryInformationLine1('Beneficiary Info Line1');
        $payment->setBeneficiaryInformationLine2('Beneficiary Info Line2');
        $payment->setBeneficiaryInformationLine3('Beneficiary Info Line3');
        $payment->setBeneficiaryInformationLine4('Beneficiary Info Line4');
        $payment->setIntermediaryBankID('Intermediary Bank ID');
        // $payment->setReceivingBankID('ReceivingBankID'); // unsupported
        $payment->setReceiverInformationLine1('/ReceiverInformationLine1');
        $payment->setReceiverInformationLine2('//ReceiverInformationLine2');
        $payment->setReceiverInformationLine3('//ReceiverInformationLine3');
        $payment->setReceiverInformationLine4('//ReceiverInformationLine4');
        $payment->setBeneficiaryEmail('test@test.com');
        $payment->setNotes('Notes');
        $payment->setSendNoteToBeneficiary('1');
        $payment->setCharges('SHA');
        $payment->setUserDefinedField1('User Defined Field 1');
        $payment->setUserDefinedField2('User Defined Field 2');
        $payment->setUserDefinedField3('User Defined Field 3');
        $payment->setUserDefinedField4('User Defined Field 4');
        $payment->setUserDefinedField5('User Defined Field 5');
        $payment->setTemplateCode('Template Code');
        $payment->setTemplateName('Template Name');
        // $payment->setReserved() // unsupported
        $payment->setPurposeOfPayment('Purpose of Payment');
        $payment->setBeneficiaryAdvising('Beneficiary Advising');
        $payment->setSystemField1('System Field 1');
        $payment->setSystemField2('System Field 2');
        $payment->setSystemField3('System Field 3');
        $payment->setSystemField4('System Field 4');
        $payment->setSystemField5('System Field 5');
        $payment->setSystemField6('System Field 6');
        $payment->setSystemField7('System Field 7');
        $payment->setSystemField8('System Field 8');
        $payment->setSystemField9('System Field 9');
        $payment->setSystemField10('System Field 10');
        $payment->setSystemField11('System Field 11');
        $payment->setSystemField12('System Field 12');
        $payment->setSystemField13('System Field 13');
        $payment->setSystemField14('System Field 14');
        $payment->setSystemField15('System Field 15');
        $payment->setSystemField16('System Field 16');
        $payment->setSystemField17('System Field 17');
        $payment->setSystemField18('System Field 18');
        $payment->setSystemField19('System Field 19');
        $payment->setSystemField20('System Field 20');

        $expected = 'US,URG,senderref,relatedref,01012020,debitacct,123.45,456.78,USD,GB,Originator Name,Originator Acct,Originator Address,Originator City,GB,Beneficiary Account,Beneficiary Name,Beneficiary Address,Beneficiary City,Beneficiary Postal Code,UK,Beneficiary Bank ID,Beneficiary Info Line1,Beneficiary Info Line2,Beneficiary Info Line3,Beneficiary Info Line4,Intermediary Bank ID,,/ReceiverInformationLine1,//ReceiverInformationLine2,//ReceiverInformationLine3,//ReceiverInformationLine4,test@test.com,Notes,1,SHA,User Defined Field 1,User Defined Field 2,User Defined Field 3,User Defined Field 4,User Defined Field 5,Template Code,Template Name,,Purpose of Payment,Beneficiary Advising,System Field 1,System Field 2,System Field 3,System Field 4,System Field 5,System Field 6,System Field 7,System Field 8,System Field 9,System Field 10,System Field 11,System Field 12,System Field 13,System Field 14,System Field 15,System Field 16,System Field 17,System Field 18,System Field 19,System Field 20';
        $this->assertEquals($expected, $payment->getCsvString());
    }

    public function testCsvOutputWithRequiredFields(): void
    {
        $payment = new Payment([]);
        $payment->setDestinationCountry('US');
        $payment->setPaymentType('URG');
        $payment->setDebitAccountNumber('123');
        $payment->setCurrency('USD');
        $payment->setBeneficiaryName('Test Name');
        $payment->setBeneficiaryAddress('Test Address');
        $payment->setBeneficiaryCity('Test City');
        $payment->setBeneficiaryCountry('US');

        $expected = 'US,URG,,,,123,,,USD,,,,,,,,Test Name,Test Address,Test City,,US,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,';
        $this->assertEquals($expected, $payment->getCsvString());
    }

    public function testExceptionIsThrownIfRequiredFieldsAreMissing(): void
    {
        $this->expectException(RequiredFieldException::class);

        $payment = new Payment([]);
        $payment->getCsvString();
    }

    public function testUsingUnsupportedReceivingBankIDFieldThrowsException(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('receivingBankID is not currently a supported field');

        $payment = new Payment([]);
        $payment->setReceivingBankID('test');
    }

    public function testUsingUnsupportedReservedFieldThrowsException(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('reserved is not currently a supported field');

        $payment = new Payment([]);
        $payment->setReserved('test');
    }
}

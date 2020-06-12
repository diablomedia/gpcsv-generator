# gpcsv-generator
Library to assist with generation of CashPro Global Payments GPCSV files

## Usage

### CLI
```bash
composer require diablomedia/gpcsv
```

### Code
```php
<?php
$payment = new GPCSV\Payment();
$payment->setDestinationCountry($country);
// Set other values...

$csv = new GPCSV\File();
$csv->addPayment($payment);
// Add other payments...

echo (string) $csv;
```

## Options

By default, the Payment class will automatically strip unsupported characters from values that are sent to it. If you would prefer it to throw an error instead, you can disable the autoClean option:

```php
<?php
$payment = new Payment(['autoClean' => false]);

// or:

$payment = new Payment();
$payment->setOptionAutomaticallyCleanFields(false);
```

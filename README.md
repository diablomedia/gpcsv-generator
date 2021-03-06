# gpcsv-generator
[![Build](https://github.com/diablomedia/gpcsv-generator/workflows/Build/badge.svg?event=push)](https://github.com/diablomedia/gpcsv-generator/actions?query=workflow%3ABuild+event%3Apush)
[![codecov](https://codecov.io/gh/diablomedia/gpcsv-generator/branch/master/graph/badge.svg)](https://codecov.io/gh/diablomedia/gpcsv-generator)
[![Latest Stable Version](https://poser.pugx.org/diablomedia/gpcsv-generator/v/stable)](https://packagist.org/packages/diablomedia/gpcsv-generator)
[![Total Downloads](https://poser.pugx.org/diablomedia/gpcsv-generator/downloads)](https://packagist.org/packages/diablomedia/gpcsv-generator)
[![Psalm Type coverage](https://shepherd.dev/github/diablomedia/gpcsv-generator/coverage.svg)](https://psalm.dev/)
[![Psalm level](https://shepherd.dev/github/diablomedia/gpcsv-generator/level.svg?)](https://psalm.dev/)

Library to assist with the generation of CashPro Global Payments GPCSV files

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

echo $csv->getCsvString();
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

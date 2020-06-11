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
$csv = new GPCSV();
$csv->setDestinationCountry($country);
// Set other values...

echo (string) $csv;
```

## Options

By default, the library will automatically strip unsupported characters from values that are sent to it. If you would prefer it to throw an error instead, you can disable the autoClean option:

```php
<?php
$csv = new GPCSV(['autoClean' => false]);

// or:

$csv = new GPCSV();
$csv->setOptionAutomaticallyCleanFields(false);
```

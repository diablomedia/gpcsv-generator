<?php declare(strict_types=1);

use Ergebnis\PhpCsFixer\Config;
use DiabloMedia\PhpCsFixer\Config\RuleSet\Php71;

$config = Config\Factory::fromRuleSet(new Php71());

$config->setCacheFile(__DIR__ . '/.php_cs.cache');
$config->getFinder()
    ->exclude('vendor')
    ->files()
    ->in(__DIR__)
;

return $config;

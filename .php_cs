<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->files()
    ->in(__DIR__)
;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        // Pre-defined rule sets
        '@PSR2' => true,
        '@PHP70Migration' => true,
        '@PHP71Migration' => true,
        '@PHP71Migration:risky' => true,
        '@PHPUnit60Migration:risky' => true,
        // Individual rules
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => [
            'default' => 'align_single_space_minimal',
            'operators' => ['||' => null, '&&' => null, '==' => null, '===' => null, '+' => null]
        ],
        'concat_space' => ['spacing' => 'one'],
        'declare_strict_types' => false,
        'dir_constant' => true,
        'no_empty_comment' => true,
        'no_empty_phpdoc' => true,
        'no_mixed_echo_print' => ['use' => 'echo'],
        'no_superfluous_phpdoc_tags' => true,
        'no_unused_imports' => true,
        'psr0' => true,
        'return_type_declaration' => ['space_before' => 'none'],
        'single_quote' => false,
        'ternary_to_null_coalescing' => true,
    ])
    ->setUsingCache(true)
    ->setFinder($finder);
;

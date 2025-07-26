<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/Source')
    ->in(__DIR__ . '/Bin')
    ->in(__DIR__ . '/tests')
    ->name('*.php')
    ->append([__FILE__])
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new PhpCsFixer\Config())
    ->setUnsupportedPhpVersionAllowed(true)
    ->setRules([
        '@PSR12' => true,
        '@PHP82Migration' => true,

        // Fix implicit nullable parameters
        'nullable_type_declaration_for_default_null_value' => true,
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true);

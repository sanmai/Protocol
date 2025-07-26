<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/Source')
    ->in(__DIR__ . '/Bin')
    ->in(__DIR__ . '/tests')
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new PhpCsFixer\Config())
    ->setUnsupportedPhpVersionAllowed(true)
    ->setRules([
        '@PSR12' => true,
        '@PHP82Migration' => true,
        
        // Fix implicit nullable parameters
        'nullable_type_declaration_for_default_null_value' => true,
        
        // Array formatting
        'array_syntax' => ['syntax' => 'short'],
        'trailing_comma_in_multiline' => [
            'elements' => ['arrays', 'arguments', 'parameters'],
        ],
        
        // Remove unused imports
        'no_unused_imports' => true,
        'ordered_imports' => [
            'imports_order' => ['class', 'function', 'const'],
            'sort_algorithm' => 'alpha',
        ],
        
        // Strict types and return types
        'declare_strict_types' => true,
        'void_return' => true,
        
        // Clean up whitespace
        'no_extra_blank_lines' => [
            'tokens' => [
                'case', 'continue', 'curly_brace_block', 'default', 'extra',
                'parenthesis_brace_block', 'square_brace_block', 'throw', 'use',
            ],
        ],
        'no_whitespace_in_blank_line' => true,
        'blank_line_before_statement' => [
            'statements' => ['return', 'throw', 'try'],
        ],
        
        // Modernize code
        'modernize_types_casting' => true,
        'no_php4_constructor' => true,
        'is_null' => true,
        
        // Consistency
        'cast_spaces' => ['space' => 'single'],
        'concat_space' => ['spacing' => 'one'],
        'binary_operator_spaces' => [
            'default' => 'single_space',
        ],
        
        // Documentation
        'phpdoc_align' => ['align' => 'left'],
        'phpdoc_separation' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_trim' => true,
        'phpdoc_var_without_name' => true,
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true);
<?php

/**
 * Post-install script to fix Hoa class conflicts with PHPStan
 * 
 * This script renames conflicting Hoa classes in vendor/ to avoid
 * "Cannot redeclare class" errors when PHPStan loads its bundled Hoa dependencies.
 */

declare(strict_types=1);

echo "Fixing Hoa/PHPStan class conflicts...\n";

$vendorDir = __DIR__ . '/../vendor';
$conflicts = [
    // Main conflict: Hoa\Consistency\Autoloader
    "$vendorDir/hoa/consistency/Source/Autoloader.php" => [
        'class Autoloader' => 'class AutoloaderLocal', 
        'Autoloader::' => 'AutoloaderLocal::',
    ],
    
    // Consistency class conflict
    "$vendorDir/hoa/consistency/Source/Consistency.php" => [
        'class Consistency' => 'class ConsistencyLocal',
        'Consistency::' => 'ConsistencyLocal::',
    ],
    
    // Update Prelude to use renamed classes
    "$vendorDir/hoa/consistency/Source/Prelude.php" => [
        'Autoloader::' => 'AutoloaderLocal::',
        'new Autoloader(' => 'new AutoloaderLocal(',
        'Consistency::' => 'ConsistencyLocal::',
        'new Consistency(' => 'new ConsistencyLocal(',
    ],
];

foreach ($conflicts as $file => $replacements) {
    if (!file_exists($file)) {
        echo "Skipping $file (not found)\n";
        continue;
    }
    
    $content = file_get_contents($file);
    $originalContent = $content;
    
    foreach ($replacements as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    
    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        echo "Fixed conflicts in $file\n";
    } else {
        echo "No changes needed in $file\n";
    }
}

echo "Hoa conflict fixes completed!\n";
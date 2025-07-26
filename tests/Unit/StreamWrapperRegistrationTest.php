<?php

declare(strict_types=1);

namespace Hoa\Protocol\Test\Unit;

use Hoa\Protocol\Wrapper;
use PHPUnit\Framework\TestCase;

/**
 * Test that Source/Wrapper.php is properly loaded via composer autoload
 * and that the stream wrapper functionality is available.
 */
class StreamWrapperRegistrationTest extends TestCase
{
    public function testWrapperClassIsLoaded(): void
    {
        // If this test runs, then Source/Wrapper.php was successfully loaded
        // via composer autoload files, because the class exists and is imported
        $this->assertTrue(
            class_exists(Wrapper::class),
            'Wrapper class should be loaded via Source/Wrapper.php autoload'
        );
    }
    
    public function testWrapperFileIsInComposerAutoloadFiles(): void
    {
        // Double-check that Source/Wrapper.php is listed in composer.json autoload files
        $composerJson = json_decode(file_get_contents(__DIR__ . '/../../composer.json'), true);
        
        $this->assertArrayHasKey('autoload', $composerJson);
        $this->assertArrayHasKey('files', $composerJson['autoload']);
        $this->assertContains(
            'Source/Wrapper.php',
            $composerJson['autoload']['files'],
            'Source/Wrapper.php must be in composer.json autoload files array'
        );
    }
    
    public function testWrapperClassHasStreamMethods(): void
    {
        // Verify the wrapper class has the required stream wrapper methods
        $reflection = new \ReflectionClass(Wrapper::class);
        
        $requiredMethods = [
            'stream_open',
            'stream_read', 
            'stream_write',
            'stream_close',
            'stream_stat',
            'url_stat'
        ];
        
        foreach ($requiredMethods as $method) {
            $this->assertTrue(
                $reflection->hasMethod($method),
                "Wrapper class should have required stream method: {$method}"
            );
        }
    }
}
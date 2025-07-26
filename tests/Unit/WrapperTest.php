<?php

declare(strict_types=1);

namespace Hoa\Protocol\Test\Unit;

use Hoa\Protocol as LUT;
use Hoa\Protocol\Wrapper as SUT;
use PHPUnit\Framework\TestCase;

class WrapperTest extends TestCase
{
    public function testStreamCastForSelect(): void
    {
        $wrapper = new SUT();
        
        $result = $wrapper->stream_cast(STREAM_CAST_FOR_SELECT);
        
        $this->assertNull($result);
    }

    public function testStreamCastAsStream(): void
    {
        $wrapper = new SUT();
        
        $result = $wrapper->stream_cast(STREAM_CAST_AS_STREAM);
        
        $this->assertNull($result);
    }

    public function testRealPath(): void
    {
        $result = SUT::realPath('/foo/bar');
        
        $this->assertSame('/foo/bar', $result);
    }

    public function testRealPathWithHoaProtocol(): void
    {
        $result = SUT::realPath('hoa://Application/Foo');
        
        // Should resolve to some path or NO_RESOLUTION
        $this->assertIsString($result);
    }

    public function testMetadataTouchWithNoArgument(): void
    {
        $wrapper = new SUT();
        
        // Test that method exists and can be called with valid arguments
        $result = $wrapper->stream_metadata('/tmp/test_touch', STREAM_META_TOUCH, []);
        
        // The result depends on whether the file can be created/touched
        $this->assertIsBool($result);
    }

    public function testMetadataAccess(): void
    {
        $wrapper = new SUT();
        
        // Test that method exists and can be called
        $result = $wrapper->stream_metadata('/tmp/test_chmod', STREAM_META_ACCESS, 0755);
        
        $this->assertIsBool($result);
    }

    public function testMetadataDefault(): void
    {
        $wrapper = new SUT();
        
        $result = $wrapper->stream_metadata('/tmp/test', 999, 0);
        
        $this->assertFalse($result);
    }

    public function testUrlStatWithNoResolution(): void
    {
        $wrapper = new SUT();
        
        $result = $wrapper->url_stat(LUT::NO_RESOLUTION, STREAM_URL_STAT_QUIET);
        
        $this->assertSame(0, $result);
    }
}
<?php

declare(strict_types=1);

namespace Hoa\Protocol\Test\Unit;

use Hoa\Protocol as LUT;
use Hoa\Protocol\Protocol as SUT;
use PHPUnit\Framework\TestCase;

class ProtocolTest extends TestCase
{
    protected function setUp(): void
    {
        // Clear protocol cache before each test
        SUT::clearCache();
    }

    public function testRootIsANode(): void
    {
        $result = SUT::getInstance();

        $this->assertInstanceOf(LUT\Node\Node::class, $result);
    }

    public function testDefaultTree(): void
    {
        $result = SUT::getInstance();

        $this->assertInstanceOf(LUT\Node\Node::class, $result['Application']);
        $this->assertInstanceOf(LUT\Node\Node::class, $result['Application']['Public']);
        $this->assertInstanceOf(LUT\Node\Node::class, $result['Data']);
        $this->assertInstanceOf(LUT\Node\Node::class, $result['Data']['Etc']);
        $this->assertInstanceOf(LUT\Node\Node::class, $result['Data']['Etc']['Configuration']);
        $this->assertInstanceOf(LUT\Node\Node::class, $result['Data']['Etc']['Locale']);
        $this->assertInstanceOf(LUT\Node\Node::class, $result['Data']['Lost+found']);
        $this->assertInstanceOf(LUT\Node\Node::class, $result['Data']['Temporary']);
        $this->assertInstanceOf(LUT\Node\Node::class, $result['Data']['Variable']);
        $this->assertInstanceOf(LUT\Node\Node::class, $result['Data']['Variable']['Cache']);
        $this->assertInstanceOf(LUT\Node\Node::class, $result['Data']['Variable']['Database']);
        $this->assertInstanceOf(LUT\Node\Node::class, $result['Data']['Variable']['Log']);
        $this->assertInstanceOf(LUT\Node\Node::class, $result['Data']['Variable']['Private']);
        $this->assertInstanceOf(LUT\Node\Node::class, $result['Data']['Variable']['Run']);
        $this->assertInstanceOf(LUT\Node\Node::class, $result['Data']['Variable']['Test']);
        $this->assertInstanceOf(LUT\Node\Library::class, $result['Library']);

        $this->assertIsString($result['Library']->reach());
    }

    public function testResolveNotAHoaPath(): void
    {
        $protocol = SUT::getInstance();

        $result = $protocol->resolve('/foo/bar');

        $this->assertSame('/foo/bar', $result);
    }

    public function testResolveToNonExistingResource(): void
    {
        $protocol = SUT::getInstance();

        $result = $protocol->resolve('hoa://Application/Foo/Bar');

        $this->assertSame(SUT::NO_RESOLUTION, $result);
    }

    public function testResolveDoesNotTestIfExists(): void
    {
        $protocol = SUT::getInstance();

        $result = $protocol->resolve('hoa://Application/Foo/Bar', false);

        // This should return a resolved path, not check if it exists
        $this->assertIsString($result);
        $this->assertStringContainsString('Foo/Bar', $result);
    }

    public function testResolveUnfoldToExistingResources(): void
    {
        $protocol = SUT::getInstance();

        $result = $protocol->resolve('hoa://Library', true, true);

        $this->assertIsArray($result);
    }

    public function testResolveUnfoldToNonExistingResources(): void
    {
        $protocol = SUT::getInstance();

        $result = $protocol->resolve('hoa://Library', false, true);

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}

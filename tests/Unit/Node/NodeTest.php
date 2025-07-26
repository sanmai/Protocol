<?php

declare(strict_types=1);

namespace Hoa\Protocol\Test\Unit\Node;

use Hoa\Protocol as LUT;
use Hoa\Protocol\Node\Node as SUT;
use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{
    public function testImplements(): void
    {
        $result = new SUT();
        
        $this->assertInstanceOf(\ArrayAccess::class, $result);
        $this->assertInstanceOf(\IteratorAggregate::class, $result);
    }

    public function testEmptyConstructor(): void
    {
        $result = new SUT();
        
        $this->assertNull($result->getName());
        $this->assertEmpty(iterator_to_array($result->getIterator()));
    }

    public function testConstructorWithAName(): void
    {
        $name = 'foo';
        
        $result = new SUT($name);
        
        $this->assertSame($name, $result->getName());
        $this->assertEmpty(iterator_to_array($result->getIterator()));
    }

    public function testConstructorWithANameAndChildren(): void
    {
        $name = 'foo';
        $children = [new SUT('bar'), new SUT('baz')];
        
        $result = new SUT($name, '', $children);
        
        $this->assertSame($name, $result->getName());
        $this->assertCount(2, iterator_to_array($result->getIterator()));
    }

    public function testOffsetSet(): void
    {
        $root = new SUT();
        $name = 'foo';
        $node = new SUT();
        $oldCountChildren = count(iterator_to_array($root->getIterator()));
        
        $root->offsetSet($name, $node);
        
        $this->assertSame($oldCountChildren + 1, count(iterator_to_array($root->getIterator())));
        $this->assertSame($node, $root[$name]);
    }

    public function testOffsetSetNotANode(): void
    {
        $this->expectException(LUT\Exception::class);
        
        $root = new SUT();
        $root->offsetSet('foo', null);
    }

    public function testOffsetSetNoName(): void
    {
        $this->expectException(LUT\Exception::class);
        
        $root = new SUT();
        $root->offsetSet(null, new SUT());
    }

    public function testOffsetGet(): void
    {
        $root = new SUT();
        $child = new SUT();
        $root['foo'] = $child;
        
        $result = $root->offsetGet('foo');
        
        $this->assertSame($child, $result);
    }

    public function testOffsetGetAnUnknownName(): void
    {
        $this->expectException(LUT\Exception::class);
        
        $root = new SUT();
        $root->offsetGet('foo');
    }

    public function testOffsetExists(): void
    {
        $root = new SUT();
        $child = new SUT();
        $root['foo'] = $child;
        
        $result = $root->offsetExists('foo');
        
        $this->assertTrue($result);
    }

    public function testOffsetNotExists(): void
    {
        $root = new SUT();
        
        $result = $root->offsetExists('foo');
        
        $this->assertFalse($result);
    }

    public function testOffsetUnset(): void
    {
        $root = new SUT();
        $child = new SUT();
        $root['foo'] = $child;
        
        $root->offsetUnset('foo');
        
        $this->assertFalse($root->offsetExists('foo'));
    }

    public function testReach(): void
    {
        $reach = 'bar';
        $node = new SUT('foo', $reach);
        
        $result = $node->reach();
        
        $this->assertSame($reach, $result);
    }

    public function testReachWithAQueue(): void
    {
        $queue = 'baz';
        $node = new SUT('foo', 'bar');
        
        $result = $node->reach('baz');
        
        $this->assertSame($queue, $result);
    }

    public function testReachId(): void
    {
        $this->expectException(LUT\Exception::class);
        
        $node = new SUT();
        $node->reachId('foo');
    }

    public function testSetReach(): void
    {
        $reach = 'bar';
        $node = new SUT('foo', $reach);
        
        $result = $node->setReach('baz');
        
        $this->assertSame($reach, $result);
        $this->assertSame('baz', $node->reach());
    }

    public function testGetName(): void
    {
        $name = 'foo';
        $node = new SUT($name);
        
        $result = $node->getName();
        
        $this->assertSame($name, $result);
    }

    public function testGetIterator(): void
    {
        $childA = new SUT('bar');
        $childB = new SUT('baz');
        $children = [$childA, $childB];
        
        $result = new SUT('foo', '', $children);
        
        $this->assertInstanceOf(\ArrayIterator::class, $result->getIterator());
        $this->assertSame([
            'bar' => $childA,
            'baz' => $childB
        ], iterator_to_array($result->getIterator()));
    }

    public function testGetRoot(): void
    {
        $result = SUT::getRoot();
        
        $this->assertSame(LUT::getInstance(), $result);
    }

    public function testToStringAsLeaf(): void
    {
        $node = new SUT('foo');
        
        $result = $node->__toString();
        
        $this->assertSame('foo' . "\n", $result);
    }

    public function testToStringAsNode(): void
    {
        $node = new SUT('foo');
        $node[] = new SUT('bar');
        $node[] = new SUT('baz');
        
        $result = $node->__toString();
        
        $this->assertSame(
            'foo' . "\n" .
            '  bar' . "\n" .
            '  baz' . "\n",
            $result
        );
    }
}
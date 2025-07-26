<?php

declare(strict_types=1);

// Stubs for missing dependencies in isolated PHPStan environment

namespace Hoa\Console\Dispatcher {
    class Kit
    {
        protected array $options = [];
        protected mixed $parser = null;

        public function getOption(mixed &$v): bool
        {
            return false;
        }
        public function usage(): int
        {
            return 0;
        }
        public function makeUsageOptionsList(array $options): string
        {
            return '';
        }
        public function resolveOptionAmbiguity(string &$v): void
        {
        }
    }
}

namespace Hoa\Console {
    class GetOption
    {
        public const NO_ARGUMENT = 0;
    }

    class Console
    {
        public static function isDirect(mixed $stream): bool
        {
            return true;
        }
    }

    class Cursor
    {
        public static function colorize(string $color): string
        {
            return '';
        }
    }
}

namespace PHPUnit\Framework {
    class TestCase
    {
        public function assertInstanceOf(string $expected, mixed $actual, string $message = ''): void
        {
        }
        public function assertIsString(mixed $actual, string $message = ''): void
        {
        }
        public function assertSame(mixed $expected, mixed $actual, string $message = ''): void
        {
        }
        public function assertIsArray(mixed $actual, string $message = ''): void
        {
        }
        public function assertNotEmpty(mixed $actual, string $message = ''): void
        {
        }
        public function assertStringContainsString(string $needle, string $haystack, string $message = ''): void
        {
        }
        public function assertNull(mixed $actual, string $message = ''): void
        {
        }
        public function assertIsBool(mixed $actual, string $message = ''): void
        {
        }
        public function assertFalse(mixed $actual, string $message = ''): void
        {
        }
        public function assertTrue(mixed $actual, string $message = ''): void
        {
        }
        public function assertArrayHasKey(int|string $key, array $array, string $message = ''): void
        {
        }
        public function assertContains(mixed $needle, iterable $haystack, string $message = ''): void
        {
        }
    }
}

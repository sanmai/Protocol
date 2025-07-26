<?php

declare(strict_types=1);

// Stubs for missing dependencies in isolated PHPStan environment

namespace Hoa\Console\Dispatcher {
    class Kit
    {
        protected $options = [];
        protected $parser = null;

        public function getOption(&$v): bool
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
        public static function isDirect($stream): bool
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
        public function assertInstanceOf(string $expected, $actual): void
        {
        }
        public function assertIsString($actual): void
        {
        }
        public function assertSame($expected, $actual): void
        {
        }
        public function assertIsArray($actual): void
        {
        }
        public function assertNotEmpty($actual): void
        {
        }
        public function assertStringContainsString(string $needle, string $haystack): void
        {
        }
        public function assertNull($actual): void
        {
        }
        public function assertIsBool($actual): void
        {
        }
        public function assertFalse($actual): void
        {
        }
    }
}

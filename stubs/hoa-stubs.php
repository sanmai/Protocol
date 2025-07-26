<?php

declare(strict_types=1);

// Comprehensive stubs for Hoa dependencies to avoid PHPStan conflicts

namespace Hoa\Protocol {
    class Exception extends \Exception {
        public function __construct(string $message = '', int $code = 0, array $arguments = [], ?\Exception $previous = null) {
            parent::__construct(sprintf($message, ...$arguments), $code, $previous);
        }
    }
    
    class Protocol {
        const NO_RESOLUTION = '/hoa/flatland';
        
        public static function getInstance(): self {
            return new self();
        }
    }
    
    namespace Node {
        class Node {
            public static function getRoot(): \Hoa\Protocol\Node\Node {
                return new self();
            }
        }
        
        class Library extends Node {
            public function __construct(string $name = '', string $reach = '') {}
        }
    }
}

namespace Hoa\Console\Dispatcher {
    class Kit {
        protected $options = [];
        protected $parser = null;
        
        public function getOption(&$v): bool { return false; }
        public function usage(): int { return 0; }
        public function makeUsageOptionsList(array $options): string { return ''; }
        public function resolveOptionAmbiguity(string &$v): void {}
    }
}

namespace Hoa\Console {
    class GetOption {
        const NO_ARGUMENT = 0;
    }
    
    class Console {
        public static function isDirect($stream): bool { return true; }
    }
    
    class Cursor {
        public static function colorize(string $color): string { return ''; }
    }
}

namespace Hoa {
    class Consistency {
        public static function flexEntity(string $class): void {}
    }
}
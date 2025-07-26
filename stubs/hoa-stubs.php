<?php

declare(strict_types=1);

namespace Hoa\Protocol {
    class Exception extends \Exception {
        public function __construct(string $message = '', int $code = 0, array $arguments = [], ?\Exception $previous = null) {
            parent::__construct(sprintf($message, ...$arguments), $code, $previous);
        }
    }
}

namespace Hoa\Console\Dispatcher {
    class Kit {
        protected $options = [];
        protected $parser;
        
        public function getOption(&$v) { return false; }
        public function usage() { return 0; }
        public function makeUsageOptionsList($options) { return ''; }
    }
}

namespace Hoa\Console {
    class GetOption {
        const NO_ARGUMENT = 0;
    }
    
    class Console {
        public static function isDirect($stream) { return true; }
    }
    
    class Cursor {
        public static function colorize($color) { return ''; }
    }
}

namespace Hoa {
    class Consistency {
        public static function flexEntity(string $class): void {}
    }
}
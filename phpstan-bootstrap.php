<?php

declare(strict_types=1);

// Define constants that might be missing
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('RS')) {
    define('RS', ';');
}

if (!defined('WITH_COMPOSER')) {
    define('WITH_COMPOSER', true);
}

// Minimal stub for Hoa\Consistency to avoid conflicts
if (!class_exists('Hoa\Consistency')) {
    class_alias(stdClass::class, 'Hoa\Consistency');
}

// Create minimal stubs for Hoa dependencies
if (!class_exists('Hoa\Protocol\Exception')) {
    class Hoa_Protocol_Exception extends Exception {}
    class_alias('Hoa_Protocol_Exception', 'Hoa\Protocol\Exception');
}

if (!class_exists('Hoa\Console\Dispatcher\Kit')) {
    class Hoa_Console_Dispatcher_Kit {
        protected $options = [];
        protected $parser;
        public function getOption(&$v) { return false; }
        public function usage() { return 0; }
        public function makeUsageOptionsList($options) { return ''; }
    }
    class_alias('Hoa_Console_Dispatcher_Kit', 'Hoa\Console\Dispatcher\Kit');
}

if (!class_exists('Hoa\Console\GetOption')) {
    class Hoa_Console_GetOption {
        const NO_ARGUMENT = 0;
    }
    class_alias('Hoa_Console_GetOption', 'Hoa\Console\GetOption');
}

if (!class_exists('Hoa\Console')) {
    class Hoa_Console {
        public static function isDirect($stream) { return true; }
    }
    class_alias('Hoa_Console', 'Hoa\Console');
}

if (!class_exists('Hoa\Console\Cursor')) {
    class Hoa_Console_Cursor {
        public static function colorize($color) { return ''; }
    }
    class_alias('Hoa_Console_Cursor', 'Hoa\Console\Cursor');
}
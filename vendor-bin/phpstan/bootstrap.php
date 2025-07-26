<?php

declare(strict_types=1);

// Bootstrap constants for PHPStan analysis only
// These constants are expected to be defined by the consuming application

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('RS')) {
    define('RS', ';');
}

if (!defined('WITH_COMPOSER')) {
    define('WITH_COMPOSER', true);
}
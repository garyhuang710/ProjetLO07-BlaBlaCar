<?php

define('DEBUG', true);

define('PROJECT_ROOT', dirname(__DIR__, 2));
define('APP_ROOT', PROJECT_ROOT . '/app');
define('VIEW_ROOT', APP_ROOT . '/view');

define('DB_HOST', getenv('BLABLACAR_DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('BLABLACAR_DB_NAME') ?: 'bosealiw');
define('DB_USER', getenv('BLABLACAR_DB_USER') ?: 'bosealiw');
define('DB_PASSWORD', getenv('BLABLACAR_DB_PASSWORD') ?: '98zPSUxe');
define('DB_CHARSET', 'utf8');

define('STUDENT_1', 'Boseali Wail');
define('STUDENT_2', 'HUANG Jia Rui');

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

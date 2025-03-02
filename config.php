<?php
// Load environment variables from .env file
$lines = file(__DIR__ . "/.env", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    $line = trim($line);
    if (strpos(trim($line), "#") === 0) continue; // Skip comments
    putenv($line);
}

define('HUMAN_DATETIME_FORMAT', 'd.m.Y H:i');
define('LOCALE_CURRENCY', 'de_DE');

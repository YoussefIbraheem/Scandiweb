<?php

$projectBase = '/Scandiweb';

$GLOBALS['projectBase'] = $projectBase;

if (php_sapi_name() === 'cli-server') {
    // For built-in PHP server
    if (strpos($_SERVER['REQUEST_URI'], $projectBase) === 0) {
        $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($projectBase));
    }
} else {
    // For Apache
    if (strpos($_SERVER['REQUEST_URI'], $projectBase) === 0) {
        $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($projectBase));
    }
}

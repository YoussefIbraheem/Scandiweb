<?php

$projectBase = '/';


$GLOBALS['basePath'] = $projectBase;
$GLOBALS['projectBase'] = 'http://' . $_SERVER['HTTP_HOST'] . $projectBase;

if (php_sapi_name() === 'apache2handler') {
    // For Apache
    if (strpos($_SERVER['REQUEST_URI'], $projectBase) === 0) {
        $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($projectBase));
    }
}

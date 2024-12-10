<?php
require __DIR__ . '/vendor/autoload.php';  
define('ROOT_URL', ($_SERVER['HTTPS'] ?? 'off') === 'on' ? 'https' : 'http' . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']));


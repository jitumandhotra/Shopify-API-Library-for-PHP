<?php
require 'vendor/autoload.php';
define('ROOT_URL', ($_SERVER['HTTPS'] ?? 'off') === 'on' ? 'https' : 'http' . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/'));

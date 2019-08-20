<?php
//header
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');
header('Expires: Tue, 01 Jan 2000 00:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base_url .= "://" . $_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
define('BASE_URL', $base_url);

define('DB_HOST', 'localhost');
define('DB_NAME', 'db_unnur');
define('DB_USER', 'kogure13');
define('DB_PASS', '@P4ssw0rd');

define('APPS_TITLE', 'sistem informasi akademik');
define('APPS_NAME', 'siakad');
define('APPS_VER', '1.0.19');

define('HASH_KEY', '');

$js = (isset($_GET['page']) ? $_GET['page'] : '');
if ($js == null) {
    $js = "home.js";
    $js = '<script src="' . BASE_URL . 'public/js/' . $js . '"></script>';
} elseif ($js == "logout") {
    $js = "";
} else {
    // $js = $js . '.js';
    $js = '<script src="' . BASE_URL . 'public/js/' . $js . '.js"></script>';
}

define('APP_Script', $js);
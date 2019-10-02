<?php
session_start();
$_SESSION['role'] = 1;
require_once 'app/init.php';

$main = new Main();

// if(!isset($_SESSION['user_apps'])) {
// $main->getLogin();
// } else {
    $main->getMain();
// }

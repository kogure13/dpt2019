<?php
session_start();
require_once 'app/init.php';

$_SESSION['role'] = 1;

$main = new Main();
$main->getMain();
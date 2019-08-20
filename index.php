<?php
session_start();
require_once 'app/init.php';

$db = new DBobj();
$connString = $db->getConnString();

if ($connString) echo 'ok';
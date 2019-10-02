<?php
session_start();
require_once '../../init.php';

$db = new DBobj();
$connString = $db->getConnString();

$requestData = $_REQUEST;
$action = (isset($requestData['action'])) ? $requestData['action'] : '';

switch ($action) {
    case 'login':
    $username = mysqli_real_escape_string($connString, $requestData['username']);
    $password = mysqli_real_escape_string($connString, $requestData['password']);

    $sql = 'select * from app_users ';
    $sql .= "where username = '".$username."'";

    $query = mysqli_query($connString, $sql) or die('error query login');
    $row = mysqli_fetch_assoc($query);

    if (($password == $row['password'])) {
        $_SESSION['user_apps'] = true;
        $_SESSION['edpt_id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        echo 1;
    } else {
        echo 0;
    }
    break;
}
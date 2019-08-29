<?php
require_once '../../init.php';

$db = new DBobj();
$connString = $db->getConnString();
$crud = new Crud($connString);

$action = (isset($requestData['action'])) ? $requestData['action'] : '';
// $action = (isset($_POST['action'])) ? $_POST['action'] : $action;
$action = (isset($_GET['action'])) ? $_GET['action'] : $action;

$data = [];

switch ($action) {
    case 'getDPT':
        $from = $_GET['tbname'];
        $field = ['*'];
        $join = $where = $order = '';

        $read = $crud->read($field, $from, $join, $where, $order);
        while ($row = mysqli_fetch_assoc($read)) {
            $data = $row;
        }
        echo json_encode($data);

        break;
}

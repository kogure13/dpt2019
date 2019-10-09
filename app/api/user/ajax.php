<?php
session_start();
require_once '../../init.php';

$db = new DBobj();
$connString = $db->getConnString();
$crud = new Crud($connString);
$fetchData = new fetchData($connString);

$requestData = $_REQUEST;
$action = (isset($requestData['action'])) ? $requestData['action'] : '';
// $action = (isset($_POST['action'])) ? $_POST['action'] : $action;
$action = (isset($_GET['action'])) ? $_GET['action'] : $action;

switch ($action) {
    case 'edit':
        $fetchData->editData($requestData, $crud);
        break;
    case 'get':
        $fetchData->getData($crud);
        break;
}

class fetchData
{
    protected $conn;

    function __construct($connString)
    {
        $this->conn = $connString;
    }

    public function getData($crud)
    {
        $from = "app_users";
        $field = ['*'];
        $where = "id = " . $_SESSION['edpt_id'];
        $join = $order = "";
        $query = $crud->read($field, $from, $join, $where, $order);

        while ($row = mysqli_fetch_assoc($query))
            $data = $row;

        echo json_encode($data);
    }

    public function editData($requestData, $crud) {
        $tb_name = "app_users";
        $data = [
            'username' => mysqli_real_escape_string($this->conn, $requestData['username']),
            'password' => mysqli_real_escape_string($this->conn, $requestData['password'])
        ];
        $where = "id = ".$_SESSION['edpt_id'];
        $query = $crud->update($tb_name, $data, $where);

        echo $query;
    }
}

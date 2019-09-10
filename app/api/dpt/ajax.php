<?php
session_start();
require_once '../../init.php';

$db = new DBobj();
$connString = $db->getConnString();
$crud = new Crud($connString);

$request = $_REQUEST;
$action = (isset($requestData['action'])) ? $requestData['action'] : '';
// $action = (isset($_POST['action'])) ? $_POST['action'] : $action;
$action = (isset($_GET['action'])) ? $_GET['action'] : $action;
$filter = (isset($_GET['filter'])) ? $_GET['filter'] : '';


switch ($action) {
    case 'getTPS':
        if ($filter == "provinsi") {
            $field = ["tps"];
            $from = "tps_provinsi";
            $where = "id_provinsi = ".$_GET['id'];
            $join = $order = "";
            $read = $crud->read($field, $from, $join, $where, $order);
            while($row = mysqli_fetch_assoc($read)) {
                $json[] = [
                    'id'=>$row['tps'], 'nama'=>$row['tps']
                ];
            }
            echo json_encode($json);
            
        } elseif ($filter == "kabkota") {
            $field = ["tps"];
            $from = "tps_kabupaten_kota";
            $where = "id_kabupaten_kota = ".$_GET['id'];
            $join = $order = "";
            $read = $crud->read($field, $from, $join, $where, $order);
            while($row = mysqli_fetch_assoc($read)) {
                $json[] = [
                    'id'=>$row['tps'], 'nama'=>$row['tps']
                ];
            }
            echo json_encode($json);

        } elseif ($filter == "kecamatan") {
            $field = ["tps"];
            $from = "tps_kecamatan";
            $where = "id_kecamatan = ".$_GET['id'];
            $join = $order = "";
            $read = $crud->read($field, $from, $join, $where, $order);
            while($row = mysqli_fetch_assoc($read)) {
                $json[] = [
                    'id'=>$row['tps'], 'nama'=>$row['tps']
                ];
            }
            echo json_encode($json);

        } elseif ($filter == "kelurahan") {
            $field = ["tps"];
            $from = "tps_kelurahan";
            $where = "id_kelurahan = ".$_GET['id'];
            $join = $order = "";
            $read = $crud->read($field, $from, $join, $where, $order);
            while($row = mysqli_fetch_assoc($read)) {
                $json[] = [
                    'id'=>$row['tps'], 'nama'=>$row['tps']
                ];
            }
            echo json_encode($json);
        }
        break;
}


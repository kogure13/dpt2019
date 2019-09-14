<?php
session_start();
require_once '../../init.php';

$db = new DBobj();
$connString = $db->getConnString();
$crud = new Crud($connString);
$fetchData = new fetchData($connString);

$requestData = $_REQUEST;
$action = (isset($requestData['action'])) ? $requestData['action'] : '';
$action = (isset($_POST['action'])) ? $_POST['action'] : $action;
$action = (isset($_GET['action'])) ? $_GET['action'] : $action;
$filter = (isset($_GET['filter'])) ? $_GET['filter'] : '';

switch ($action) {
    case 'getTPS':
        if ($filter == "provinsi") {
            $field = ["tps"];
            $from = "tps_provinsi";
            $where = "id_provinsi = " . $_GET['id'];
            $join = $order = "";
            $read = $crud->read($field, $from, $join, $where, $order);
            while ($row = mysqli_fetch_assoc($read)) {
                $json[] = [
                    'id' => $row['tps'], 'nama' => $row['tps']
                ];
            }
            echo json_encode($json);
        } elseif ($filter == "kabkota") {
            $field = ["tps"];
            $from = "tps_kabupaten_kota";
            $where = "id_kabupaten_kota = " . $_GET['id'];
            $join = $order = "";
            $read = $crud->read($field, $from, $join, $where, $order);
            while ($row = mysqli_fetch_assoc($read)) {
                $json[] = [
                    'id' => $row['tps'], 'nama' => $row['tps']
                ];
            }
            echo json_encode($json);
        } elseif ($filter == "kecamatan") {
            $field = ["tps"];
            $from = "tps_kecamatan";
            $where = "id_kecamatan = " . $_GET['id'];
            $join = $order = "";
            $read = $crud->read($field, $from, $join, $where, $order);
            while ($row = mysqli_fetch_assoc($read)) {
                $json[] = [
                    'id' => $row['tps'], 'nama' => $row['tps']
                ];
            }
            echo json_encode($json);
        } elseif ($filter == "kelurahan") {
            $field = ["tps"];
            $from = "tps_kelurahan";
            $where = "id_kelurahan = " . $_GET['id'];
            $join = $order = "";
            $read = $crud->read($field, $from, $join, $where, $order);
            while ($row = mysqli_fetch_assoc($read)) {
                $json[] = [
                    'id' => $row['tps'], 'nama' => $row['tps']
                ];
            }
            echo json_encode($json);
        }
        break;
    case 'cariDPT':
        $kode_filter = (!empty($requestData['kode_provinsi'])) ? $requestData['kode_provinsi'] : 0;
        $kode_filter = (!empty($requestData['kode_kabkota'])) ? $requestData['kode_kabkota'] : $kode_filter;
        $kode_filter = (!empty($requestData['kode_kecamatan'])) ? $requestData['kode_kecamatan'] : $kode_filter;
        $kode_filter = (!empty($requestData['kode_kelurahan'])) ? $requestData['kode_kelurahan'] : $kode_filter;
        $field = ['d.nik', 'd.nama', 'd.alamat', 'd.jenis_kelamin', 'd.tps', 'k.nama_kelurahan', 'kc.nama_kecamatan', 'kk.nama_kabupaten_kota', 'p.nama_provinsi'];
        $from = "dpt d";
        $join = "JOIN kelurahan k on k.id_kelurahan = d.id_kelurahan ";
        $join .= "JOIN kecamatan kc on kc.id_kecamatan = k.id_kecamatan ";
        $join .= "JOIN kabupaten_kota kk on kk.id_kabupaten_kota = kc.id_kabupaten_kota ";
        $join .= "JOIN provinsi p on p.id_provinsi = kk.id_provinsi";
        $where = "(p.kode_provinsi = " . $kode_filter;
        $where .= " or kk.kode_kabupaten_kota = " . $kode_filter;
        $where .= " or kc.kode_kecamatan = " . $kode_filter;
        $where .= " or k.kode_kelurahan = " . $kode_filter . ")";
        $where .= " and (d.nik like '" . $requestData['niknama'] . "%' or d.nama like '" . $requestData['niknama'] . "%')";
        if (!empty($requestData['selectTPS'])) {
            $where .= " and d.tps = '" . $requestData['selectTPS'] . "'";
        }
        $order = "";
        $read = $crud->read($field, $from, $join, $where, $order);
        print_r($read);
        break;
    default:
        echo json_encode($fetchData->getNulldataTable());
        break;
}

class fetchData
{
    protected $conn;

    function __construct($connString)
    {
        $this->conn = $connString;
    }

    public function getNulldataTable()
    {
        $json_data = [
            "draw" => 0,
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => 0,
        ];

        return $json_data;
    }
}

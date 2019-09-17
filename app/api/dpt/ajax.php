<?php
session_start();
require_once '../../init.php';

$db = new DBobj();
$connString = $db->getConnString();
$crud = new Crud($connString);
$fetchData = new fetchData($connString);
$userUI = new Main();

$requestData = $_REQUEST;
$requestData = $_POST;
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
        $columns = [];
        echo json_encode($fetchData->getDataTable($requestData, $columns, $crud, $userUI));
        // echo $requestData['niknama'];
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

    public function getDataTable($requestData, $col, $crud, $userUI)
    {
        $kode_filter = (!empty($requestData['kode_provinsi'])) ? $requestData['kode_provinsi'] : 0;
        $kode_filter = (!empty($requestData['kode_kabkota'])) ? $requestData['kode_kabkota'] : $kode_filter;
        $kode_filter = (!empty($requestData['kode_kecamatan'])) ? $requestData['kode_kecamatan'] : $kode_filter;
        $kode_filter = (!empty($requestData['kode_kelurahan'])) ? $requestData['kode_kelurahan'] : $kode_filter;

        // $fieldCOunt = ['count(*) as count'];
        $field = "select d.id_dpt, d.nik, d.nama, d.alamat, d.jenis_kelamin, d.tps, k.nama_kelurahan, kc.nama_kecamatan, kk.nama_kabupaten_kota, p.nama_provinsi ";
        $from = "dpt d ";
        $join = "JOIN kelurahan k on k.id_kelurahan = d.id_kelurahan ";
        $join .= "JOIN kecamatan kc on kc.id_kecamatan = k.id_kecamatan ";
        $join .= "JOIN kabupaten_kota kk on kk.id_kabupaten_kota = kc.id_kabupaten_kota ";
        $join .= "JOIN provinsi p on p.id_provinsi = kk.id_provinsi ";
        $where = "(p.kode_provinsi = " . $kode_filter;
        $where .= " or kk.kode_kabupaten_kota = " . $kode_filter;
        $where .= " or kc.kode_kecamatan = " . $kode_filter;
        $where .= " or k.kode_kelurahan = " . $kode_filter . ")";
        $where .= " and (d.nik like '%" . $requestData['niknama'] . "%' or d.nama like '%" . $requestData['niknama'] . "%') ";
        if (!empty($requestData['tps']))
            $where .= " and d.tps = '" . $requestData['tps'] . "'";

        $sqfilter = $field . " from " . $from . " " . $join . " where " . $where;
        $sql = $sqfilter;
        $qfilter = mysqli_query($this->conn, $sqfilter) or die('error fecth filter data');
        $totalData = mysqli_num_rows($qfilter);
        $totalFilter = $totalData;

        // $sql = $field . " from " . $from . " " . $join . " where " . $where;
        // exit();

        if (!empty($requestData['search']['value'])) {
            $sql .= " or d.nik like '" . $requestData['search']['value'] . "%'";
            $sql .= " or d.nama like '" . $requestData['search']['value'] . "%'";

            $query = mysqli_query($this->conn, $sql) or die("error num search");
            $totalFilter = mysqli_num_rows($query);

            $sql .= " order by tps, nama_kelurahan, nama_kecamatan, nama_kabupaten_kota, nama_provinsi";
            $sql .= " limit " . $requestData['start'] . " , " . $requestData['length'] . " ";

            $query = mysqli_query($this->conn, $sql) or die("error fetch search");
        } else {
            $sql .= " order by tps, nama, nama_kelurahan, nama_kecamatan, nama_kabupaten_kota, nama_provinsi";
            $sql .= " limit " . $requestData['start'] . " , " . $requestData['length'] . " ";
            // echo $sql;
            // exit();
            $query = mysqli_query($this->conn, $sql) or die("error fetch data");
        }

        while ($row = mysqli_fetch_assoc($query)) {
            $nesdata = [];

            $nesdata[] = $userUI->actInterview($row['id_dpt']);
            $nesdata[] = strtoupper($row['nama']);
            $nesdata[] = strtoupper($row['nik']);
            $nesdata[] = strtoupper($row['alamat']);
            $nesdata[] = strtoupper($row['jenis_kelamin']);
            $nesdata[] = strtoupper($row['tps']);
            $nesdata[] = strtoupper($row['nama_kelurahan']);
            $nesdata[] = strtoupper($row['nama_kecamatan']);
            $nesdata[] = strtoupper($row['nama_kabupaten_kota']);
            $nesdata[] = strtoupper($row['nama_provinsi']);

            $data[] = $nesdata;
        }

        if ($totalFilter > 0) {
            $json_data = [
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFilter),
                "data" => $data,
            ];
        } else {
            $json_data = $this->getNulldataTable();
        }
        return $json_data;
        // echo json_encode($json_data);
    }
}

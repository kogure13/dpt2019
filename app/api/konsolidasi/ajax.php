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

switch($action) {
case 'cariKonsolidasi' : 
$columns = [];
echo json_encode($fetchData->getDataTable($requestData, $columns, $crud, $userUI));
break;
}

class fetchData {
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

    public function getDataTable($requestData, $col, $crud, $userUI) {
        $kode_filter = (!empty($requestData['kode_provinsi'])) ? $requestData['kode_provinsi'] : 0;
        $kode_filter = (!empty($requestData['kode_kabkota'])) ? $requestData['kode_kabkota'] : $kode_filter;
        $kode_filter = (!empty($requestData['kode_kecamatan'])) ? $requestData['kode_kecamatan'] : $kode_filter;
        $kode_filter = (!empty($requestData['kode_kelurahan'])) ? $requestData['kode_kelurahan'] : $kode_filter;

        $field = "";
        $from = "";
        $join = "";
        $where = "";

        $sqfilter = $field . " from " . $from . " " . $join . " where " . $where;
        $sql = $sqfilter;
        $qfilter = mysqli_query($this->conn, $sqfilter) or die('error fecth filter data');
        $totalData = mysqli_num_rows($qfilter);
        $totalFilter = $totalData;

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
            $nesdata[] = strtoupper($row['banyak_pemilih']);
            $nesdata[] = strtoupper($row['id_pilihan']);
            $nesdata[] = strtoupper($row['id_tipe_pemilih']);
            $nesdata[] = strtoupper($row['nomor_kontak']);

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
    }
}
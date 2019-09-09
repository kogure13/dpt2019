<?php
session_start();
require_once '../../init.php';

$db = new DBobj();
$connString = $db->getConnString();
$getTPS = new getTPS($connString);

$request = $_REQUEST;
$action = (isset($requestData['action'])) ? $requestData['action'] : '';
// $action = (isset($_POST['action'])) ? $_POST['action'] : $action;
$action = (isset($_GET['action'])) ? $_GET['action'] : $action;

switch ($action) {
    case 'getTPS':
        if ($_GET['filter'] == "provinsi") {
            $text = "p.id_provinsi=" . $_GET['id'];
            $data = $getTPS->getRecords($text);
            echo json_encode($data);
        }
        break;
}

class getTPS
{
    protected $conn;

    function __construct($connString)
    {
        $this->conn = $connString;
    }

    public function getRecords($text)
    {
        $sql = "select distinct (d.tps) as tps
        from dpt d
        join kelurahan k on k.id_kelurahan = d.id_kelurahan
        join kecamatan kc on kc.id_kecamatan = k.id_kecamatan
        join kabupaten_kota kk on kk.id_kabupaten_kota = kc.id_kabupaten_kota
        join provinsi p on p.id_provinsi = kk.id_provinsi";
        $sql .= " where " . $text;

        $query = mysqli_query($this->conn, $sql) or die("Error query data");
        while ($row = mysqli_fetch_assoc($query)) {
            $json[] = [
                'id' => $row['tps'],
                'nama' => $row['tps']
            ];
        }

        return $json;
    }
}
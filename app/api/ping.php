<?php
session_start();
require_once '../init.php';

$db = new DBobj();
$connString = $db->getConnString();
$crud = new Crud($connString);
// update DPT
$field = ["dpt"];
$from = "dashboard";
$join = $where = $order = "";
$qDPT = $crud->read($field, $from, $join, $where, $order);
$rDPT = mysqli_fetch_assoc($qDPT);
$countDPT = $rDPT['dpt'];
//end update DPT

// count dpt
$field = ["count(*) as dpt"];
$from = "dpt";
$join = $where = $order = "";
$query = $crud->read($field, $from, $join, $where, $order);
$row = mysqli_fetch_assoc($query);
$count = $row['dpt'];
// end count dpt

if($countDPT < $count) {
    // echo "ok";
    $proses = new Proses($connString);
    $proses->callProses();
} else {
    echo 'skipped';
}

class Proses {

    protected $conn;

    function __construct($connString)
    {
        $this->conn = $connString;
    }

    function callProses() {
        // mysqli_query($this->conn, 'CALL update_dashboard()');
        // mysqli_query($this->conn, 'CALL tps_provinsi()');
        // mysqli_query($this->conn, 'CALL tps_kabupaten_kota()');
        // mysqli_query($this->conn, 'CALL tps_kecamtan()');
        // mysqli_query($this->conn, 'CALL tps_kelurahan()');
        return;
    }
}


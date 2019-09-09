<?php
require_once '../../init.php';
header("Content-Type: text/json");

$db = new DBobj;
$connString = $db->getConnString();

$term = trim(strip_tags($_GET['term']));

$qstring = "SELECT id_provinsi, nama_provinsi FROM provinsi";

$qstring .= " WHERE nama_provinsi LIKE '%" . $term . "%'";
// echo $qstring;
// exit();
//query database untuk mengecek tabel Country 
$result = mysqli_query($connString, $qstring) or die();
while ($row = mysqli_fetch_assoc($result)) {
    $json[] = array(
        'label' => $row['nama_provinsi'],
        'value' => ucwords($row['nama_provinsi']),
        'id' => $row['id_provinsi']
    );
}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($json);
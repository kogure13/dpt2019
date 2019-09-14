<?php
require_once '../../init.php';
header("Content-Type: text/json");

$db = new DBobj;
$connString = $db->getConnString();

$term = trim(strip_tags($_GET['term']));

$qstring = "SELECT kk.id_kabupaten_kota, kk.kode_kabupaten_kota, kk.nama_kabupaten_kota, p.nama_provinsi FROM kabupaten_kota kk";

$qstring .= " join provinsi p on p.id_provinsi = kk.id_provinsi";
$qstring .= " WHERE kk.nama_kabupaten_kota LIKE '%" . $term . "%' or p.nama_provinsi LIKE '%" . $term . "%'";
$qstring .= " order by kk.nama_kabupaten_kota, p.nama_provinsi limit 20";
// echo $qstring;
// exit();
//query database untuk mengecek tabel Country 
$result = mysqli_query($connString, $qstring) or die();
while ($row = mysqli_fetch_assoc($result)) {
    $json[] = array(
        'kode' => $row['kode_kabupaten_kota'],
        'label' => $row['nama_kabupaten_kota'] . ' - ' . $row['nama_provinsi'],
        'value' => ucwords($row['nama_kabupaten_kota']),
        'id' => $row['id_kabupaten_kota']
    );
}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($json);
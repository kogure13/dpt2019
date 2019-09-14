<?php
require_once '../../init.php';
header("Content-Type: text/json");

$db = new DBobj;
$connString = $db->getConnString();

$term = trim(strip_tags($_GET['term']));

$qstring = "SELECT k.id_kecamatan, k.kode_kecamatan, k.nama_kecamatan, kk.nama_kabupaten_kota, p.nama_provinsi FROM kecamatan k";

$qstring .= " join kabupaten_kota kk on kk.id_kabupaten_kota = k.id_kabupaten_kota";
$qstring .= " join provinsi p on p.id_provinsi = kk.id_provinsi";
$qstring .= " WHERE k.nama_kecamatan LIKE '%" . $term . "%' or";
$qstring .= " kk.nama_kabupaten_kota LIKE '%" . $term . "%' or p.nama_provinsi LIKE '%" . $term . "%'";
$qstring .= " order by k.nama_kecamatan, kk.nama_kabupaten_kota, p.nama_provinsi limit 20";
// echo $qstring;
// exit();

$result = mysqli_query($connString, $qstring) or die();
while ($row = mysqli_fetch_assoc($result)) {
    $json[] = array(
        'kode' => $row['kode_kecamatan'],
        'label' => $row['nama_kecamatan'] . ' - ' . $row['nama_kabupaten_kota'] . ' - ' . $row['nama_provinsi'],
        'value' => ucwords($row['nama_kecamatan']),
        'id' => $row['id_kecamatan']
    );
}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($json);
<?php
require_once '../../init.php';
header("Content-Type: text/json");

$db = new DBobj;
$connString = $db->getConnString();

$term = trim(strip_tags($_GET['term']));

$qstring = "SELECT kl.id_kelurahan, kl.kode_kelurahan, kl.nama_kelurahan, k.nama_kecamatan, kk.nama_kabupaten_kota, p.nama_provinsi FROM kelurahan kl";
$qstring .= " join kecamatan k on k.id_kecamatan = kl.id_kecamatan";
$qstring .= " join kabupaten_kota kk on kk.id_kabupaten_kota = k.id_kabupaten_kota";
$qstring .= " join provinsi p on p.id_provinsi = kk.id_provinsi";
$qstring .= " WHERE kl.nama_kelurahan LIKE '%" . $term . "%' or k.nama_kecamatan LIKE '%" . $term . "%' or";
$qstring .= " kk.nama_kabupaten_kota LIKE '%" . $term . "%' or p.nama_provinsi LIKE '%" . $term . "%'";
$qstring .= " order by kl.nama_kelurahan, k.nama_kecamatan, kk.nama_kabupaten_kota, p.nama_provinsi limit 20";
// echo $qstring; exit();
//query database untuk mengecek tabel Country 
$result = mysqli_query($connString, $qstring) or die();
while ($row = mysqli_fetch_assoc($result)) {
    $json[] = array(
        'kode' => $row['kode_kelurahan'],
        'label' => $row['nama_kelurahan'] . ' - ' . $row['nama_kecamatan'] . ' - ' . $row['nama_kabupaten_kota'] . ' - ' . $row['nama_provinsi'],
        'value' => ucwords($row['nama_kelurahan']),
        'id' => $row['id_kelurahan']
    );
}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($json);
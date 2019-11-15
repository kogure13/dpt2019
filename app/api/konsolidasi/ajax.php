<?php
session_start();
require_once '../../init.php';

$db = new DBobj();
$connString = $db->getConnString();
$crud = new Crud($connString);
$fetchData = new fetchData($connString);
$userUI = new Konsolidasi($connString);

$requestData = $_REQUEST;
// $requestData = $_POST;
$action = (isset($requestData['action'])) ? $requestData['action'] : '';
$action = (isset($_POST['action'])) ? $_POST['action'] : $action;
$action = (isset($_GET['action'])) ? $_GET['action'] : $action;
$filter = (isset($_GET['filter'])) ? $_GET['filter'] : '';

$kode_filter = (!empty($requestData['kode_provinsi'])) ? $requestData['kode_provinsi'] : 0;
$kode_filter = (!empty($requestData['kode_kabkota'])) ? $requestData['kode_kabkota'] : $kode_filter;
$kode_filter = (!empty($requestData['kode_kecamatan'])) ? $requestData['kode_kecamatan'] : $kode_filter;
$kode_filter = (!empty($requestData['kode_kelurahan'])) ? $requestData['kode_kelurahan'] : $kode_filter;
$kode_filter = (!empty($requestData['kode_filter'])) ? $requestData['kode_filter'] : $kode_filter;

switch ($action) {
    case 'cariKonsolidasi':
        $columns = [];
        echo json_encode($fetchData->getDataTable($requestData, $columns, $crud, $userUI, $kode_filter));
        break;
    case 'countKonsolidasi':
        $columns = [];
        echo json_encode($fetchData->countKonsolidasi($requestData, $columns, $crud, $userUI, $kode_filter));
        break;
    case 'countKategori':
        $columns = [];
        $fetchData->countKategori($requestData, $columns, $crud, $userUI, $kode_filter);
        break;

    case 'edit':        
        $tb_name = 'master_interview';
        $data = [
            'id_tipe_pemilih'=>mysqli_real_escape_string($connString, $requestData['itipe_pemilih']),
            'id_pilihan'=>mysqli_real_escape_string($connString, $requestData['imemilih']),
            'nomor_kontak'=>mysqli_real_escape_string($connString, $requestData['ikontak']),
            'banyak_pemilih'=>mysqli_real_escape_string($connString, $requestData['ibanyak_pemilih'])
        ];
        $where = "kode_dpt = '".mysqli_real_escape_string($connString, $requestData['kodePemilih'])."'";

        $msg = $crud->update($tb_name, $data, $where);
        break;
    case 'updateInterview':
        $field = ['*'];
        $from = 'master_interview';
        $join = $order = '';
        $where = 'kode_dpt = ' . $_GET['id'];
        $query = $crud->read($field, $from, $join, $where, $order);
        while ($row = mysqli_fetch_assoc($query)) {
            $data = $row;
        }
        echo json_encode($data);
        break;
    case 'hapus':
        //update memlih = 0
        $sql = "update dpt set memilih = 0 where kode_dpt = '".$requestData['id']."'";
        $exec = mysqli_query($connString, $sql) or die(E_ERROR);
        //hapus data
        $data = "kode_dpt = '".$requestData['id']."'";
        $exec1 = $crud->delete("master_interview", $data);
        //hapus detail
        $exec2 = $crud->delete("detail_interview", $data);

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

    public function getDataTable($requestData, $col, $crud, $userUI, $kode_filter)
    {
        $field = "SELECT d.kode_dpt, d.nama, d.nik, d.alamat, d.jenis_kelamin, m.banyak_pemilih, kp.nama_pilihan, tp.nama_tipe, m.nomor_kontak, d.tps";
        $from = "dpt d";
        $join = "JOIN master_interview m on m.kode_dpt = d.kode_dpt";
        $join .= " JOIN kategori_pilihan kp on kp.id_pilihan = m.id_pilihan";
        $join .= " JOIN tipe_pemilih tp on tp.id_tipe = m.id_tipe_pemilih";
        $join .= " JOIN kelurahan kl on kl.id_kelurahan = d.id_kelurahan";
        $join .= " JOIN kecamatan kc on kc.id_kecamatan = kl.id_kecamatan";
        $join .= " JOIN kabupaten_kota kk on kk.id_kabupaten_kota = kc.id_kabupaten_kota";
        $join .= " JOIN provinsi p on p.id_provinsi = kk.id_provinsi";
        $where = "(p.kode_provinsi = " . $kode_filter;
        $where .= " or kk.kode_kabupaten_kota = " . $kode_filter;
        $where .= " or kc.kode_kecamatan = " . $kode_filter;
        $where .= " or kl.kode_kelurahan = " . $kode_filter . ")";
        if (!empty($requestData['selectTPS'])) $where .= " and d.tps = " . $requestData['selectTPS'];
        if (!empty($requestData['memilih'])) $where .= " and kp.id_pilihan = " . $requestData['memilih'];
        if (!empty($requestData['tipe_pemilih'])) $where .= " and tp.id_tipe = " . $requestData['tipe_pemilih'];
        if (!empty($requestData['kontak'])) {
            if ($requestData['kontak'] == 'all') {
                $where .= ' ';
            } elseif ($requestData['kontak'] == 0) {
                $where .= " and (m.nomor_kontak = '' and m.nomor_kontak = '-') ";
            } elseif ($requestData['kontak'] == 1) {
                $where .= " and (m.nomor_kontak != '' and m.nomor_kontak != '-') ";
            }
        }

        $sqfilter = $field . " from " . $from . " " . $join . " where " . $where;
        // echo $sqfilter;
        // exit();
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
            $sql .= " limit " . $requestData['start'] . ", " . $requestData['length'] . " ";
            // echo $sql;
            // exit();
            $query = mysqli_query($this->conn, $sql) or die("error fetch data");
        }

        while ($row = mysqli_fetch_assoc($query)) {
            $nesdata = [];

            $nesdata[] = $userUI->actKonsolidasi($row['kode_dpt']);
            $nesdata[] = strtoupper($row['nama']);
            $nesdata[] = strtoupper($row['nik']);
            $nesdata[] = strtoupper($row['alamat']);
            $nesdata[] = strtoupper($row['jenis_kelamin']);
            $nesdata[] = strtoupper($row['banyak_pemilih']);
            $nesdata[] = strtoupper($row['nama_pilihan']);
            $nesdata[] = strtoupper($row['nama_tipe']);
            $nesdata[] = strtoupper($row['nomor_kontak']);
            $nesdata[] = strtoupper($row['tps']);

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

    public function countKonsolidasi($requestData, $col, $crud, $userUI, $kode_filter)
    {
        $field = "SELECT count(*) AS konsolidasi";
        $from = "FROM (SELECT d.nama, d.nik, d.alamat, d.jenis_kelamin, m.banyak_pemilih, kp.nama_pilihan, tp.nama_tipe, m.nomor_kontak 
        FROM dpt d
        JOIN master_interview m on m.kode_dpt = d.kode_dpt
        JOIN kategori_pilihan kp on kp.id_pilihan = m.id_pilihan
        JOIN tipe_pemilih tp on tp.id_tipe = m.id_tipe_pemilih
        JOIN kelurahan kl on kl.id_kelurahan = d.id_kelurahan
        JOIN kecamatan kc on kc.id_kecamatan = kl.id_kecamatan
        JOIN kabupaten_kota kk on kk.id_kabupaten_kota = kc.id_kabupaten_kota
        JOIN provinsi p on p.id_provinsi = kk.id_provinsi";
        $where = "WHERE (p.kode_provinsi = " . $kode_filter . " 
        or kk.kode_kabupaten_kota = " . $kode_filter . " 
        or kc.kode_kecamatan = " . $kode_filter . " 
        or kl.kode_kelurahan = " . $kode_filter . ")";
        if (!empty($requestData['memilih'])) $where .= " and kp.id_pilihan = " . $requestData['memilih'];
        if (!empty($requestData['selectTPS'])) $where .= " and d.tps = " . $requestData['selectTPS'];
        if (!empty($requestData['tipe_pemilih'])) $where .= " and tp.id_tipe = " . $requestData['tipe_pemilih'];
        if (!empty($requestData['kontak'])) {
            if ($requestData['kontak'] == 'all') {
                $where .= ' ';
            } elseif ($requestData['kontak'] == 0) {
                $where .= " and (m.nomor_kontak = '' and m.nomor_kontak = '-') ";
            } elseif ($requestData['kontak'] == 1) {
                $where .= " and (m.nomor_kontak != '' and m.nomor_kontak != '-') ";
            }
        }
        $where .= ") AS konsolidasi";
        $sql = $field . " " . $from . " " . $where;
        // echo $sql;
        // exit();
        $query = mysqli_query($this->conn, $sql) or die("Count Error");
        $row = mysqli_fetch_assoc($query);
        $json_data = $row;
        return $json_data;
    }

    public function countKategori($requestData, $col, $crud, $userUI, $kode_filter)
    {

        $sql = "select kategori_pilihan, sum(jumlah) as jumlah
        from
        (
            select kode_pilihan as kategori_pilihan, 0 as jumlah
            from kategori_pilihan
        
            union all
        
            select kp.kode_pilihan as kategori_pilihan, sum(mi.banyak_pemilih) as jumlah
            from kategori_pilihan kp
            join master_interview mi on mi.id_pilihan = kp.id_pilihan
            join tipe_pemilih tp on tp.id_tipe = mi.id_tipe_pemilih
            join dpt d on d.kode_dpt = mi.kode_dpt
            join kelurahan kl on kl.id_kelurahan = d.id_kelurahan
            join kecamatan kc on kc.id_kecamatan = kl.id_kecamatan
            join kabupaten_kota kk on kk.id_kabupaten_kota = kc.id_kabupaten_kota
            join provinsi p on p.id_provinsi = kk.id_provinsi
            where (p.kode_provinsi = '" . $kode_filter . "' or 
            kk.kode_kabupaten_kota = '" . $kode_filter . "' or 
            kc.kode_kecamatan = '" . $kode_filter . "' or 
            kl.kode_kelurahan = '" . $kode_filter . "')";
        if (!empty($requestData['memilih'])) $sql .= " and kp.id_pilihan = " . $requestData['memilih'];
        if (!empty($requestData['selectTPS'])) $sql .= " and d.tps = " . $requestData['selectTPS'];
        if (!empty($requestData['tipe_pemilih'])) $sql .= " and tp.id_tipe = " . $requestData['tipe_pemilih'];
        if (!empty($requestData['kontak'])) {
            if ($requestData['kontak'] == 'all') {
                $sql .= ' ';
            } elseif ($requestData['kontak'] == 0) {
                $sql .= " and (m.nomor_kontak = '' and m.nomor_kontak = '-') ";
            } elseif ($requestData['kontak'] == 1) {
                $sql .= " and (m.nomor_kontak != '' and m.nomor_kontak != '-') ";
            }
        }
        $sql .= "            
            group by kp.kode_pilihan
        ) as potensi
        group by kategori_pilihan
        order by kategori_pilihan asc";
        // echo $sql;
        // exit();
        $query = mysqli_query($this->conn, $sql) or die("Count Error");
        while ($row = mysqli_fetch_assoc($query)) {
            $json_data[] = $row['jumlah'];
        }

        echo json_encode($json_data);
    }
}

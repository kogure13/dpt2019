<?php
session_start();

require_once '../init.php';
$db = new DBobj();
$connString = $db->getConnString();

$kode_filter = $_GET['kode_filter'];
$kode_tps = $_GET['kode_tps'];

$field = "select k.nama_kelurahan, kc.nama_kecamatan, kk.nama_kabupaten_kota, p.nama_provinsi ";
$from = "dpt d ";
$join = "JOIN kelurahan k on k.id_kelurahan = d.id_kelurahan ";
$join .= "JOIN kecamatan kc on kc.id_kecamatan = k.id_kecamatan ";
$join .= "JOIN kabupaten_kota kk on kk.id_kabupaten_kota = kc.id_kabupaten_kota ";
$join .= "JOIN provinsi p on p.id_provinsi = kk.id_provinsi ";
$where = "(p.kode_provinsi = " . $kode_filter;
$where .= " or kk.kode_kabupaten_kota = " . $kode_filter;
$where .= " or kc.kode_kecamatan = " . $kode_filter;
$where .= " or k.kode_kelurahan = " . $kode_filter . ")";

$sql = $field . " from " . $from . " " . $join . " where " . $where;
$query = mysqli_query($connString, $sql) or die("error fetch data");
$data = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="../../public/bower_components/bootstrap/dist/css/bootstrap.min.css" media="print">

    <style>
        @page {
            size: landscape;
            margin: 5mm 5mm 5mm 5mm;
            /* change the margins as you want them to be. */
        }

        html {
            margin: 0;
            padding: 0;
            font-family: "Arial";
            font-size: 8px;
            /* font-weight: 600; */
        }

        body {
            font: 10pt Georgia, "Times New Roman", Times, serif;
        }

        img {
            width: 45%;
        }

        header {
            border-bottom: 1px solid #333;
            margin: auto;
            margin-bottom: 20px;
            vertical-align: top;
            font-family: "Serif";
            font: 24pt;
            font-weight: 600;
            white-space: nowrap;
        }

        #lookup>thead>tr>th {
            text-align: center;
            vertical-align: top;
        }
    </style>
</head>

<body>
    <header>
        <div class="row">
            <div class="col-xs-3" align="right">
                <img src="../../public/assets/images/logo-jsi.jpg" alt="">
            </div>
            <div class="col-xs-7 text-center">
                REKAP DAFTAR DPT <br />
                Kelurahan: <?= $data['nama_kelurahan'] ?> Kecamatan: <?= $data['nama_kecamatan'] ?> <br />
                Kabupaten/Kota: <?= $data['nama_kabupaten_kota'] ?> Provinsi: <?= $data['nama_provinsi'] ?> <br />
            </div>
        </div>
        <br>
    </header>

    <section id="content">
        <!-- Table Data DPT -->
        <table id="lookup" class="table table-bordered table-responsive table-condensed table-hover table-striped nowrap" style="width: 100%">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>NIK</th>
                    <th>Tempat lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>TPS</th>
                    <th>Kelurahan</th>
                    <th>Kecamatan</th>
                    <th>Kabupaten/Kota</th>
                    <th>Provinsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $field = "select d.id_dpt, d.kode_dpt, d.nik, d.nama, d.alamat, d.jenis_kelamin, d.tps, k.nama_kelurahan, kc.nama_kecamatan, kk.nama_kabupaten_kota, p.nama_provinsi ";
                $from = "dpt d ";
                $join = "JOIN kelurahan k on k.id_kelurahan = d.id_kelurahan ";
                $join .= "JOIN kecamatan kc on kc.id_kecamatan = k.id_kecamatan ";
                $join .= "JOIN kabupaten_kota kk on kk.id_kabupaten_kota = kc.id_kabupaten_kota ";
                $join .= "JOIN provinsi p on p.id_provinsi = kk.id_provinsi ";
                $where = "(p.kode_provinsi = " . $kode_filter;
                $where .= " or kk.kode_kabupaten_kota = " . $kode_filter;
                $where .= " or kc.kode_kecamatan = " . $kode_filter;
                $where .= " or k.kode_kelurahan = " . $kode_filter . ")";
                $where .= " and (d.nik like '%" . $_GET['niknama'] . "%' or d.nama like '%" . $_GET['niknama'] . "%') ";
                if (!empty($kode_tps))
                    $where .= " and d.tps = '" . $kode_tps . "'";
                $order = " order by nama asc";
                $sql = $field . " from " . $from . " " . $join . " where " . $where . " " . $order;
                $query = mysqli_query($connString, $sql) or die("error fetch data");
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<tr>";
                    echo "<td>" . strtoupper($row['nama']) . "</td>";
                    echo "<td>" . strtoupper($row['nik']) . "</td>";
                    echo "<td>" . strtoupper($row['alamat']) . "</td>";
                    echo "<td class=\"text-center\">" . strtoupper($row['jenis_kelamin']) . "</td>";
                    echo "<td class=\"text-center\">" . strtoupper($row['tps']) . "</td>";
                    echo "<td>" . strtoupper($row['nama_kelurahan']) . "</td>";
                    echo "<td>" . strtoupper($row['nama_kecamatan']) . "</td>";
                    echo "<td>" . strtoupper($row['nama_kabupaten_kota']) . "</td>";
                    echo "<td>" . strtoupper($row['nama_provinsi']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <script type="text/javascript">
        window.focus();
        window.print();
        window.close();
    </script>
</body>

</html>
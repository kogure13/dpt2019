<?php
session_start();

require_once '../init.php';
$db = new DBobj();
$connString = $db->getConnString();

$kode_filter = $_GET['kode_filter'];
$kode_tps = $_GET['kode_tps'];

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
            font-weight: 600
        }

        img {
            width: 64px;
        }

        header {
            border-bottom: 1px solid #ccc;
            width: 90%;
            margin: auto;
            margin-bottom: 20px;
        }

        header>table {
            width: 60%;
            padding: 0;
            margin: auto;
            margin-bottom: 5px;
            vertical-align: top;
            font-family: "Serif";
        }
    </style>
</head>

<body>
    <header>
        <table>
            <tr>
                <td width="10%">
                    <img src="../../public/assets/images/logo.png" alt="">
                </td>
                <td align="center">
                    DAFTAR DPT <br />
                    REKAP DATA DPT <br />
                </td>
            </tr>
        </table>
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

                if (!empty($kode_tps))
                    $where .= " and d.tps = '" . $kode_tps . "'";
                ?>
            </tbody>
        </table>
    </section>

    <script type="text/javascript">
        window.print();
        window.close();
    </script>
</body>

</html>
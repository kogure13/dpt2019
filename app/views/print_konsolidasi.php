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

    <link rel="stylesheet" href="../../public/bower_components/bootstrap/dist/css/bootstrap.min.css" media="">

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

<body onload="window.print()" onfocus="window.close()">
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
                    <th>Jumlah Pemilih</th>
                    <th>Pilihan Pileg</th>
                    <th>Tipe Pemilih</th>
                    <th>Kontak</th>
                    <th>TPS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $field = "select d.kode_dpt, d.nama, d.nik, d.alamat, d.jenis_kelamin, m.banyak_pemilih, kp.nama_pilihan, tp.nama_tipe, m.nomor_kontak, d.tps ";
                $from = "dpt d ";
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

                if (!empty($kode_tps))
                    $where .= " and d.tps = '" . $kode_tps . "'";
                if (!empty($_GET['memilih'])) $where .= " and kp.id_pilihan = " . $_GET['memilih'];
                if (!empty($_GET['tipe_pemilih'])) $where .= " and tp.id_tipe = " . $_GET['tipe_pemilih'];
                if (!empty($_GET['kontak'])) {
                    if ($_GET['kontak'] == 'all') {
                        $where .= ' ';
                    } elseif ($_GET['kontak'] == 0) {
                        $where .= " and (m.nomor_kontak = '' and m.nomor_kontak = '-') ";
                    } elseif ($_GET['kontak'] == 1) {
                        $where .= " and (m.nomor_kontak != '' and m.nomor_kontak != '-') ";
                    }
                }
                $order = " order by nama asc";
                $sql = $field . " from " . $from . " " . $join . " where " . $where . " " . $order;
                $numRow = $sql;
                $qnum = mysqli_query($connString, $numRow);
                $numRow = mysqli_num_rows($qnum);
                // echo $sql;
                $query = mysqli_query($connString, $sql) or die("error fetch data");
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<tr>";
                    echo "<td>" . strtoupper($row['nama']) . "</td>";
                    echo "<td>" . strtoupper($row['nik']) . "</td>";
                    echo "<td>" . strtoupper($row['alamat']) . "</td>";
                    echo "<td>" . strtoupper($row['jenis_kelamin']) . "</td>";
                    echo "<td class=\"text-center\">" . strtoupper($row['banyak_pemilih']) . "</td>";
                    echo "<td>" . strtoupper($row['nama_pilihan']) . "</td>";
                    echo "<td>" . strtoupper($row['nama_tipe']) . "</td>";
                    echo "<td>" . strtoupper($row['nomor_kontak']) . "</td>";
                    echo "<td class=\"text-center\">" . strtoupper($row['tps']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <?php
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
        if (!empty($_GET['memilih'])) $sql .= " and kp.id_pilihan = " . $_GET['memilih'];
        if (!empty($_GET['selectTPS'])) $sql .= " and d.tps = " . $_GET['selectTPS'];
        if (!empty($_GET['tipe_pemilih'])) $sql .= " and tp.id_tipe = " . $_GET['tipe_pemilih'];
        if (!empty($_GET['kontak'])) {
            if ($_GET['kontak'] == 'all') {
                $sql .= ' ';
            } elseif ($_GET['kontak'] == 0) {
                $sql .= " and (m.nomor_kontak = '' and m.nomor_kontak = '-') ";
            } elseif ($_GET['kontak'] == 1) {
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
        $total = 0;
        $query = mysqli_query($connString, $sql) or die("Count Error");
        while ($row = mysqli_fetch_assoc($query)) {
            $json_data[] = $row['jumlah'];
            $total = $total + $json_data[0]+$json_data[1]+$json_data[2];
        }
        ?>

        <strong> Rekap Konsolidasi </strong>
        <hr style="margin: 5px 0; border: 1px solid #ddd;">
        <span>Total data yang ditemukan: <b id="tdyd" class="pkdefault"><?=$numRow?></b> Orang</span>
        <hr style="margin: 5px 0; border: 1px solid #ddd;">
        <table class="table-condensed table-responsive">
            <tr>
                <td>Pemilih Kategori A <span class="hidden-xs">&#40;PARTAI SAYA DAN CALEG SAYA&#41;</span></td>
                <td>: <b id="pka" class="pkdefault"><?=$json_data[0]?></b> Orang</td>
            </tr>
            <tr>
                <td>Pemilih Kategori B <span class="hidden-xs">&#40;PARTAI SAYA NAMUN BELUM ADA CALEG&#41;</span></td>
                <td>: <b id="pkb" class="pkdefault"><?=$json_data[1]?></b> Orang</td>
            </tr>
            <tr>
                <td>Pemilih Kategori C <span class="hidden-xs">&#40;TIDAK TAHU &#47; TIDAK MENJAWAB&#41;</span></td>
                <td>: <b id="pkc" class="pkdefault"><?=$json_data[2]?></b> Orang</td>
            </tr>
            <tr>
                <td>Pemilih Kategori D <span class="hidden-xs">&#40;PARTAI SAYA NAMUN CALEG LAIN&#41;</span></td>
                <td>: <b id="pkd" class="pkdefault"><?=$json_data[3]?></b> Orang</td>
            </tr>
            <tr>
                <td>Pemilih Kategori E <span class="hidden-xs">&#40;PARTAI LAIN DAN CALEG LAIN&#41;</span></td>
                <td>: <b id="pke" class="pkdefault"><?=$json_data[4]?></b> Orang</td>
            </tr>
        </table>
        <hr style="margin: 5px 0; border: 1px solid #ddd">
        <span>Potensi Pemilih : <b id="pp" class="pkdefault"><?=$total?></b> Orang</span>
    </section>

    <script type="text/javascript">
        window.focus();
        window.print();
        window.close();
    </script>

</body>

</html>
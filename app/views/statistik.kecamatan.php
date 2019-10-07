<?php
require_once '../init.php';
$db = new DBobj();
$connString = $db->getConnString();
$crud = new Crud($connString);

(isset($_GET['id'])) ? $where = "id_kabupaten_kota = ".$_GET['id'] : $where = "";

?>

<table id="statistik" class="table-statistik table-responsive table-condensed table-striped">
    <thead>
        <tr>
            <th class="nosort" rowspan="2">#</th>
            <th rowspan="2">Nama Kecamatan</th>
            <th rowspan="2">Jumlah <br> Kelurahan</th>
            <th colspan="3">Jumlah DPT</th>
            <th rowspan="2">Jumlah <br> TPS</th>
        </tr>
        <tr>
            <th>Laki-laki</th>
            <th>Perempuan</th>
            <th>Jumlah Pemilih</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        $field = ['*'];
        $from = "statistik_kecamatan";
        $join = "";
        $order = "nama_kecamatan";
        $query = $crud->read($field, $from, $join, $where, $order);
        while($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td class="text-right"><?=$i++?></td>
                <td data-id="<?=$row['id_kecamatan']?>" class="namaAct"><?=$row['nama_kecamatan']?></td>
                <td class="text-center"><?=number_format($row['jumlah_kelurahan'])?></td>
                <td class="text-right"><?=number_format($row['dpt_laki_laki'])?></td>
                <td class="text-right"><?=number_format($row['dpt_perempuan'])?></td>
                <td class="text-right"><?=number_format($row['jumlah_dpt'])?></td>
                <td class="text-center"><?=number_format($row['jumlah_tps'])?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

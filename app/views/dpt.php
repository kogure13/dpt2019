<div class="content-wrapper">
    <section class="content-header">
        <h1>Daftar DPT<small></small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-6 col-sm-4 col-md-2">
                                <div class="form-group" for="">
                                    <?php
                                    select($data = [
                                        'name="pilihFilter"', 'class="form-control pilihFilter"',
                                        'id="idPilihFilter"',
                                    ], $title = "Filter Berdasarkan", $option = [
                                        'provinsi' => 'Provinsi', 'kabkota' => 'Kabupaten/Kota', 'kecamatan' => 'Kecamatan', 'kelurahan' => 'Kelurahan',
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="form-group is-empty pilihView" id="default">
                                    <?php
                                    input($attr = [
                                        'type="text"', 'class="form-control"', 'disabled="disabled"', 'placeholder="Filter Daerah"'
                                    ]);
                                    ?>
                                </div>
                                <div class="form-group is-empty pilihView" id="kelurahan" style="display: none">
                                    <?php
                                    input($attr = [
                                        'type="hidden"', 'name="id_kelurahan"',
                                        'id="id_kelurahan"', 'autocomplete="off"',
                                    ]);
                                    input($attr = [
                                        'type="text"', 'name="tags_kelurahan"',
                                        'id="tags_kelurahan"', 'class="form-control"',
                                        'autocomplete="off"', 'placeholder="Kelurahan/Kecamatan/Kabupaten Kota/Provinsi"',
                                    ]);
                                    ?>
                                </div>
                                <div class="form-group is-empty pilihView" id="kecamatan" style="display: none">
                                    <?php
                                    input($attr = [
                                        'type="hidden"', 'name="id_kecamatan"',
                                        'id="id_kecamatan"', 'autocomplete="off"',
                                    ]);
                                    input($attr = [
                                        'type="text"', 'name="tags_kecamatan"',
                                        'id="tags_kecamatan"', 'class="form-control"',
                                        'autocomplete="off"', 'placeholder="Kecamatan/Kabupaten Kota/Provinsi"',
                                    ]);
                                    ?>
                                </div>
                                <div class="form-group is-empty pilihView" id="kabkota" style="display: none">
                                    <?php
                                    input($attr = [
                                        'type="hidden"', 'name="id_kabkota"',
                                        'id="id_kabkota"', 'autocomplete="off"',
                                    ]);
                                    input($attr = [
                                        'type="text"', 'name="tags_kabkota"',
                                        'id="tags_kabkota"', 'class="form-control"',
                                        'autocomplete="off"', 'placeholder="Kabupaten Kota/Provinsi"',
                                    ]);
                                    ?>
                                </div>
                                <div class="form-group is-empty pilihView" id="provinsi" style="display: none">
                                    <?php
                                    input($attr = [
                                        'type="hidden"', 'name="id_provinsi"',
                                        'id="id_provinsi"', 'autocomplete="off"',
                                    ]);
                                    input($attr = [
                                        'type="text"', 'name="tags_provinsi"',
                                        'id="tags_provinsi"', 'class="form-control"',
                                        'autocomplete="off"', 'placeholder="Provinsi"',
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <div class="col-xs-2 col-sm-1 col-md-1">
                                <div class="form-group is-empty">
                                    <select name="selectTPS" id="selectTPS" class="form-control" disabled="disabled">
                                        <option value="">TPS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-10 col-sm-4 col-md-4">
                                <div class="input-group">
                                    <div class="form-group is-empty">
                                        <?php
                                        input($attr = [
                                            'type="text"', 'name="niknama"', 'id="niknama"', 'class="form-control"',
                                            'placeholder="Cari NIK/NAMA"', 'disabled="disabled"', 'autocomplete="off"'
                                        ]);
                                        ?>
                                    </div>
                                    <span class="input-group-btn">
                                        <?php
                                        button($attr = [
                                            'type="button"', 'id="btnCari"', 'class="btn btn-sm bg-aqua"',
                                        ], $data = ['Cari'])
                                        ?>
                                    </span>
                                </div>
                            </div>

                        </div> <!-- end row -->
                        <!-- Table Data DPT -->
                        <table id="lookup"
                            class="table table-responsive table-condensed table-hover table-striped nowrap"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="nosort">#</th>
                                    <th>Nama Lengkap</th>
                                    <th>NIK</th>
                                    <th>Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>TPS</th>
                                    <th>Kelurahan</th>
                                    <th>Kecamatan</th>
                                    <th>Kabupaten/Kota</th>
                                    <th>Provinsi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
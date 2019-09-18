<div class="content-wrapper">
    <section class="content-header">
        <h1>Daftar DPT<small></small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-body">
                        <form name="formAdd" id="formAdd" role="form">
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
                                            'type="hidden"', 'name="kode_kelurahan"', 'class="formClear"',
                                            'id="kode_kelurahan"'
                                        ]);
                                        input($attr = [
                                            'type="hidden"', 'name="id_kelurahan"', 'class="formClear"',
                                            'id="id_kelurahan"', 'autocomplete="off"',
                                        ]);
                                        input($attr = [
                                            'type="text"', 'name="tags_kelurahan"',
                                            'id="tags_kelurahan"', 'class="form-control formClear"',
                                            'autocomplete="off"', 'placeholder="Kelurahan/Kecamatan/Kabupaten Kota/Provinsi"',
                                        ]);
                                        ?>
                                    </div>
                                    <div class="form-group is-empty pilihView" id="kecamatan" style="display: none">
                                        <?php
                                        input($attr = [
                                            'type="hidden"', 'name="kode_kecamatan"', 'class="formClear"',
                                            'id="kode_kecamatan"'
                                        ]);
                                        input($attr = [
                                            'type="hidden"', 'name="id_kecamatan"', 'class="formClear"',
                                            'id="id_kecamatan"', 'autocomplete="off"',
                                        ]);
                                        input($attr = [
                                            'type="text"', 'name="tags_kecamatan"',
                                            'id="tags_kecamatan"', 'class="form-control formClear"',
                                            'autocomplete="off"', 'placeholder="Kecamatan/Kabupaten Kota/Provinsi"',
                                        ]);
                                        ?>
                                    </div>
                                    <div class="form-group is-empty pilihView" id="kabkota" style="display: none">
                                        <?php
                                        input($attr = [
                                            'type="hidden"', 'name="kode_kabkota"', 'class="formClear"',
                                            'id="kode_kabkota"'
                                        ]);
                                        input($attr = [
                                            'type="hidden"', 'name="id_kabkota"', 'class="formClear"',
                                            'id="id_kabkota"', 'autocomplete="off"',
                                        ]);
                                        input($attr = [
                                            'type="text"', 'name="tags_kabkota"',
                                            'id="tags_kabkota"', 'class="form-control formClear"',
                                            'autocomplete="off"', 'placeholder="Kabupaten Kota/Provinsi"',
                                        ]);
                                        ?>
                                    </div>
                                    <div class="form-group is-empty pilihView" id="provinsi" style="display: none">
                                        <?php
                                        input($attr = [
                                            'type="hidden"', 'name="kode_provinsi"', 'class="formClear"',
                                            'id="kode_provinsi"'
                                        ]);
                                        input($attr = [
                                            'type="hidden"', 'name="id_provinsi"', 'class="formClear"',
                                            'id="id_provinsi"'
                                        ]);
                                        input($attr = [
                                            'type="text"', 'name="tags_provinsi"',
                                            'id="tags_provinsi"', 'class="form-control formClear"',
                                            'autocomplete="off"', 'placeholder="Provinsi"',
                                        ]);
                                        ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-1 col-md-1">
                                    <div class="form-group is-empty">
                                        <select name="selectTPS" id="selectTPS" class="form-control formClear" disabled="disabled">
                                            <option value="">TPS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-10 col-sm-4 col-md-4">
                                    <div class="input-group">
                                        <div class="form-group is-empty">
                                            <?php
                                            input($attr = [
                                                'type="text"', 'name="niknama"', 'id="niknama"', 'class="form-control formClear"',
                                                'placeholder="Cari NIK/NAMA"', 'disabled="disabled"', 'autocomplete="off"'
                                            ]);
                                            ?>
                                        </div>
                                        <span class="input-group-btn">
                                            <input type="hidden" name="action" id="action" value="cariDPT">
                                            <?php
                                            button($attr = [
                                                'type="button"', 'id="btnCari"', 'class="btnCari btn btn-sm bg-aqua"',
                                            ], $data = ['<i class="fa fa-search"></i> Cari'])
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div> <!-- end row -->
                        </form> <!-- end form -->

                        <!-- Table Data DPT -->
                        <table id="lookup" class="table table-bordered table-responsive table-condensed table-hover table-striped nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="nosort">Act</th>
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
                        </table>
                        <!-- Span test -->
                        <span id="spanTest"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="interviewModel" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modalTitleInterView" class="modal-title"></h4>
            </div>
            <form id="formInterview" name="formInterview" class="" novalidate="novalidate" data-form="formInterview">
                <div class="modal-body">
                    <div class="">
                        <input type="hidden" value="interview" name="action" id="actionInterview">
                        <input type="hidden" value="0" name="idPemilih" id="idPemilih">
                        <input type="hidden" value="0" name="kotaInterview" id="kotaInterview">
                        <input type="hidden" value="0" name="kecamatanInterview" id="kecamatanInterview">
                        <input type="hidden" value="0" name="kelurahanInterview" id="kelurahanInterview">
                        <input type="hidden" value="<?= date('Y-m-d H:i:s'); ?>" name="waktu" id="waktu">
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <select name="tipe_pemilih" id="tipe_pemilih" class="tipe form-control">
                                    <option value="">Tipe Pemilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <select name="memilih" id="memilih" class="memilih form-control">
                                <option value="">Pilihan Anda Di Pileg</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="input-group">
                            <div class="form-group is-empty">
                                <input type="text" name="banyak_pemilih" id="banyak_pemilih" class="form-control" placeholder="Jumlah Pemilih Dalam Satu Rumah">
                            </div>
                            <span class="input-group-addon">Orang</span>
                            </div>
                            
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <input type="text" name="kontak" id="kontak" class="form-control" placeholder="Nomor Kontak">
                            </div>
                        </div>
                    </div>

                    <div id="qa" class="row"></div>
                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                        <button type="button" id="btnAddInterview" class="btn btn-sm bg-gray">
                                <i class="fa fa-edit fa-fw"></i> Tambah Pertanyaan
                            </button>
                            <button type="button" id="btnCancelInterview" class="btn btn-sm btn-danger bg-red" data-dismiss="modal">
                                <i class="fa fa-times fa-fw"></i> Close
                            </button>
                            <button type="submit" id="btnSubmitInterview" class="btn btn-sm btn-primary bg-blue-active">
                                <i class="fa fa-save fa-fw"></i> Simpan
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Konsolidasi<small></small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" id="filter" class="btn btn-aqua bg-aqua">Filter <div class="ripple-container"></div></button>
                            </div>
                            <!-- /btn-group -->
                            <div class="form-group is-empty"><input type="text" id="filter" class="form-control" disabled="disabled" placeholder="Filter Data"></div>
                        </div>
                        <!-- Table Data Konsolidasi -->
                        <table id="lookup" class="table table-bordered table-responsive table-condensed table-hover table-striped nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="nosort">Act</th>
                                    <th>Nama Lengkap</th>
                                    <th>NIK</th>
                                    <th>Tempat Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Jml Pemilih</th>
                                    <th>Pilihan Pileg</th>
                                    <th>Tipe Pemilih</th>
                                    <th>Kontak</th>
                                </tr>
                            </thead>
                        </table>
                        <!-- Span test -->
                        <strong> Rekap Konsolidasi </strong>
                        <hr style="margin: 5px 0; border: 1px solid #ddd;">
                        <span>Total data yang ditemukan: <b id="tdyd" class="pkdefault">0</b> Orang</span>
                        <br>
                        <span>Pemilih yang dikunjungi: <b id="pyd" class="pkdefault">0</b> Orang</span>
                        <hr style="margin: 5px 0; border: 1px solid #ddd;">
                        <ul style="list-style: none; padding-left: 0px">
                            <li>Pemilih Kategori A &#40;PARTAI SAYA DAN CALEG SAYA&#41;: <b id="pka" class="pkdefault">0</b> Orang</li>
                            <li>Pemilih Kategori B &#40;PARTAI SAYA NAMUN BELUM ADA CALEG&#41;: <b id="pkb" class="pkdefault">0</b> Orang</li>
                            <li>Pemilih Kategori C &#40;TIDAK TAHU &#47; TIDAK MENJAWAB&#41;: <b id="pkc" class="pkdefault">0</b> Orang</li>
                            <li>Pemilih Kategori D &#40;PARTAI SAYA NAMUN CALEG LAIN&#41;: <b id="pkd" class="pkdefault">0</b> Orang</li>
                            <li>Pemilih Kategori E &#40;PARTAI LAIN DAN CALEG LAIN&#41;: <b id="pke" class="pkdefault">0</b> Orang</li>
                        </ul>
                        <hr style="margin: 5px 0; border: 1px solid #ddd">
                        <span>Potensi Pemilih : <b id="pp" class="pkdefault">0</b> Orang</span>
                        <span id="spanTest"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="filterModel" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modalTitle" class="modal-title"></h4>
            </div>
            <form id="formFilter" name="formFilter" class="formClear" novalidate="novalidate" data-form="formFilter">
                <div class="modal-body">
                    <input type="hidden" value="cariKonsolidasi" name="action" id="action">
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
                    <div class="row">
                        <div class="col-xs-10 col-sm-10">
                            <div class="form-group is-empty">
                                <select name="memilih" id="memilih" class="memilih form-control">
                                    <option value="">Pilihan Anda Di Pileg</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group is-empty">
                                <select name="selectTPS" id="selectTPS" class="form-control formClear" disabled="disabled">
                                    <option value="">TPS</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8 col-xs-8">
                            <div class="form-group is-empty">
                                <select name="tipe_pemilih" id="tipe_pemilih" class="tipe form-control">
                                    <option value="">Tipe Pemilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-4">
                            <div class="form-group is-empty">
                                <select name="kontak" id="kontak" class="kontak form-control">
                                    <option value="all">Kontak</option>
                                    <option value="0">Tidak Memberi Kontak</option>
                                    <option value="1">Memberi Kontak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="">
                        <button type="button" id="btnCancelFilter" class="btn btn-sm btn-danger bg-red" data-dismiss="modal">Close</button>
                        <button type="button" id="btnSubmitFilter" class="btn btn-sm btn-primary bg-aqua">
                            <i class="fa fa-search fa-fw"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
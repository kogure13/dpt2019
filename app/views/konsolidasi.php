<div class="content-wrapper">
    <section class="content-header">
        <h1>Konsolidasi<small></small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-3 col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <strong> Rekap Konsolidasi </strong>
                    </div>
                    <div class="box-body">
                        <span>Total data yang ditemukan: <b id="tdyd" class="pkdefault"></b> Orang</span>
                        <br>
                        <span>Pemilih yang dikunjungi: <b id="pyd" class="pkdefault"></b> Orang</span>
                        <hr style="margin: 5px 0; border: 1px solid #ddd;">
                        <ul style="list-style: none; padding-left: 0px">
                            <li>Pemilih Kategori A : <b id="pka" class="pkdefault"></b> Orang</li>
                            <li>Pemilih Kategori B : <b id="pkb" class="pkdefault"></b> Orang</li>
                            <li>Pemilih Kategori C : <b id="pkc" class="pkdefault"></b> Orang</li>
                            <li>Pemilih Kategori D : <b id="pkd" class="pkdefault"></b> Orang</li>
                            <li>Pemilih Kategori E : <b id="pke" class="pkdefault"></b> Orang</li>
                        </ul>
                        <hr style="margin: 5px 0; border: 1px solid #ddd">
                        <span>Potensi Pemilih : <b id="pp" class="pkdefault"></b> Orang</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-xs-12">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-aqua bg-aqua">Filter <div class="ripple-container"></div></button>
                            </div>
                            <!-- /btn-group -->
                            <div class="form-group is-empty"><input type="text" id="filter" class="form-control" disabled="disabled" placeholder="Filter Data"></div>
                        </div>

                        <!-- Table Data DPT -->
                        <table id="lookup" class="table table-bordered table-responsive table-condensed table-hover table-striped nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Act</th>
                                    <th>Nama Lengkap</th>
                                    <th>NIK</th>
                                    <th>Tempat Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Jml Pemilih</th>
                                    <th>Pilihan Pileg</th>
                                    <th>Tipe Pemilih</th>
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
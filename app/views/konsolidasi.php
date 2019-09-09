<div class="content-wrapper">
    <section class="content-header">
        <h1>Konsolidasi<small></small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group is-empty">
                                    <?php
                                    input($attr = [
                                        'type="hidden"', 'name="id_kecamatan"',
                                        'id="id_kecamatan"', 'autocomplete="off"',
                                    ]);
                                    input($attr = [
                                        'type="text"', 'name="tags_kecamatan"',
                                        'id="tags_kecamatan"', 'class="form-control"',
                                        'autocomplete="off"', 'placeholder="Kelurahan"'
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="input-group">
                                    <div class="form-group is-empty">
                                        <?php
                                        input($attr = [
                                            'type="hidden"', 'name="id_niknamatps"',
                                            'id="id_niknamatps"', 'autocomplete="off"',
                                        ]);
                                        input($attr = [
                                            'type="text"', 'name="tags_niknamatps"',
                                            'id="tags_niknamatps"', 'class="form-control"',
                                            'autocomplete="off"', 'placeholder="NIK/Nama/TPS"'
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
                        </div>

                        <table id="lookup"></table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
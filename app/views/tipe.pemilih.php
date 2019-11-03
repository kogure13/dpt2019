<div class="content-wrapper">
    <section class="content-header">
        <h1>Pengaturan Tipe Pemilih <small></small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <table id="lookup" class="table table-condensed table-responsive 
				table-striped" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="nosort"></th>
                            <th width="auto">Kode Tipe Pemilih</th>
                            <th>Nama Tipe</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>

<div id="addModel" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modalTitle" class="modal-title"></h4>
            </div>
            <form id="formMenu" name="formMenu" class="" novalidate="novalidate" data-form="formMenu">
                <div class="modal-body">
                    <div class="">
                        <input type="hidden" value="addMenu" name="action" id="action">
                        <input type="hidden" value="<?= date('Y-m-d H:i:s'); ?>" name="waktu" id="waktu">
                        <input type="hidden" value="0" name="editID" id="editID">
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="">
                                <?php
                                input($attribut = [
                                    'type="text"', 'name="kode"', 'id="kode"',
                                    'class="input-md form-control"', 'placeholder="Kode Tipe"',
                                    'autocomplete="off"'
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="">
                                <?php
                                input($attribut = [
                                    'type="text"', 'name="nama"', 'id="nama"',
                                    'class="form-control"', 'placeholder="Nama Tipe"',
                                    'autocomplete="off"'
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <button type="button" id="btnCancel" class="btn btn-sm btn-danger bg-red" data-dismiss="modal">
                                <i class="fa fa-times fa-fw"></i> Close
                            </button>
                            <button type="submit" id="btnSubmit" class="btn btn-sm btn-primary bg-blue-active">
                                <i class="fa fa-save fa-fw"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <section class="content-header">
        <h1>User Profile<small>Settings</small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4">
                                <form id="formUser" class="form-horizontal">
                                    <div class="form-group is-empty">
                                        <label for="" class="col-sm-3 control-label">Username</label>
                                        <div class="col-sm-9">
                                            <?php
                                            input($data = [
                                                'type="text"', 'name="username"', 'id="username"', 'class="form-control"',
                                                'autocomplete="off"', 'placeholder="Username"'
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group is-empty">
                                        <label for="" class="col-sm-3 control-label">Password</label>
                                        <div class="col-sm-9">
                                            <?php
                                            input($data = [
                                                'type="password"', 'name="password"', 'id="password"', 'class="form-control"',
                                                'autocomplete="off"', 'placeholder="Password"'
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <?php
                                        button($att = [
                                            'type="button"', 'id="btnSave"', 'class="btn btn-sm bg-green"'
                                        ], $data = [
                                            '<i class="fa fa-save"></i> Update Changes'
                                        ]);
                                        ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<footer class="main-footer">
    &copy; <?= date('Y') ?> | <?= strtoupper(APPS_NAME) ?>
    <div class="pull-right">
        Design By | Techno Solusitama
    </div>

</footer>
</div>

<script src="<?= BASE_URL ?>public/plugins/jQueryUI/jquery-3.2.1.min.js"></script>
<script src="<?= BASE_URL ?>public/plugins/jQueryUI/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?= BASE_URL ?>public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= BASE_URL ?>public/dist/js/material.min.js"></script>
<script src="<?= BASE_URL ?>public/dist/js/ripples.min.js"></script>
<script>
    $.material.init();
</script>

<script src="<?= BASE_URL ?>public/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= BASE_URL ?>public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="<?= BASE_URL ?>public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= BASE_URL ?>public/bower_components/fastclick/lib/fastclick.js"></script>

<script src="<?= BASE_URL ?>public/dist/js/adminlte.min.js"></script>
<script src="<?= BASE_URL ?>public/dist/js/demo.js"></script>

<script src="<?= BASE_URL ?>public/dist/js/jquery.validate.min.js"></script>
<script src="<?= BASE_URL ?>app/js/default.js"></script>
<?= APP_Script ?>
</body>

</html>
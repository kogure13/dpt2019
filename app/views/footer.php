<footer class="main-footer">
    <div class="hidden-xs hidden-sm">
        &copy; <?= date('Y') ?> | <?= strtoupper(CP_NAME) ?>
        <div class="pull-right">
            Design By | Techno Solusitama
        </div>
    </div>

    <div class="hidden-md hidden-lg">
        &copy; <?= date('Y') ?> | <?= strtoupper(CP_SHORT) ?>
        <div class="pull-right">
            Design By | Techno Solusitama
        </div>
    </div>


</footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
<script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
<script src="<?= BASE_URL ?>public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script> -->

<script src="<?= BASE_URL ?>public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= BASE_URL ?>public/plugins/iCheck/icheck.min.js"></script>
<script src="<?= BASE_URL ?>public/bower_components/fastclick/lib/fastclick.js"></script>

<script src="<?= BASE_URL ?>public/dist/js/adminlte.min.js"></script>
<script src="<?= BASE_URL ?>public/bower_components/chart.js/Chart.js"></script>

<script src="<?= BASE_URL ?>public/dist/js/jquery.validate.min.js"></script>

<script src="<?= BASE_URL ?>app/js/default.js"></script>
<?= APP_Script ?>
</body>

</html>
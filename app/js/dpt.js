$(function() {
  $(".btnCari").attr("disabled", true);
  var dump = $("#idPilihFilter").change(function(e) {
    e.preventDefault();
    $form = $(".formClear");
    $form.val("");

    $(".form-control,.btnCari").attr("disabled", false);
    var inputValue = $(this).val();
    var targetBox = $("#" + inputValue);
    $(".pilihView")
      .not(targetBox)
      .hide();
    $(targetBox).show();
  });

  // dataTable
  var dTable = $("#lookup").dataTable({
    responsive: true,
    serverSide: true,
    order: [],
    pageLength: 20,
    language: {
      sSearch: "_INPUT_",
      sSearchPlaceholder: "Search...",
      sLengthMenu: "_MENU_"
    },
    aoColumnDefs: [{ aTargets: ["nosort"], bSortable: false }],
    ajax: {
      url: host + "/app/api/dpt/ajax.php",
      type: "post",
      data: function(data) {
        data.kode_provinsi = $("#kode_provinsi").val();
        data.kode_kabkota = $("#kode_kabkota").val();
        data.kode_kecamatan = $("#kode_kecamatan").val();
        data.kode_kelurahan = $("#kelurahan").val();
        data.tps = $("#selectTPS").val();
        data.niknama = $("#niknama").val();
      }
    }
  });
  //end datatable

  //search proses
  $(".btnCari").on("click", function(e) {
    e.preventDefault();
    data = $("#formAdd").serializeArray();
    dTable = $("#lookup").dataTable();

    dump = $.ajax({
      url: host + "/app/api/dpt/ajax.php",
      type: "post",
      data: data,
      success: function(response) {
        dTable.ajax.reload();
      }
    });
  });
});

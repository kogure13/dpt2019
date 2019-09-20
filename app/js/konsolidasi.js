$(function() {
  $("#filter").on("click", function(e){
    e.preventDefault();
    $("#filterModel").modal({
      backdrop: "static",
            keyboard: false
    });

    $("#modalTitle").html("Filter Konsolidasi");
    $("#idPilihFilter").change(function(e) {
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
  });// end filter

  dTable = $("#lookup").dataTable({
    autoWidth: true,
    scrollX: true,
    responsive: true,
    serverSide: true,
    processing: true,
    ordering: false,
    lengthChange: false,
    pageLength: 20,
    language: {
      sSearch: "_INPUT_",
      sSearchPlaceholder: "Search...",
      sLengthMenu: "_MENU_"
    },
    aoColumnDefs: [
      {
        aTargets: ["nosort"],
        bSortable: false
      },
      {
        aTargets: [0, 4, 5],
        className: "text-center"
      }
    ],
    ajax: {
      url: host+"/app/api/konsolidasi/ajax.php",
      type: "post",
      data: function(data) {
        data.kode_provinsi = $("#kode_provinsi").val();
        data.kode_kabkota = $("#kode_kabkota").val();
        data.kode_kecamatan = $("#kode_kecamatan").val();
        data.kode_kelurahan = $("#kode_kelurahan").val();
        data.tps = $("#selectTPS").val();
        data.action = $("#action").val();
        data.tipe = $("#tipe_pemilih").val();
        data.pilihan = $("#memilih").val();
        data.kontak = $("#kontak").val();
      }
    }
  });// end datatable

  //search proses
  $("#btnSubmitFilter").on("click", function(e) {
    dTable.api().ajax.reload();
  });
});
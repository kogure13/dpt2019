$(function() {
  $("#filter").on("click", function(e) {
    e.preventDefault();
    $("#filterModel").modal({
      backdrop: "static",
      keyboard: false
    });
    $("#modalTitle").html("Filter Konsolidasi");
    $("#btnCancelFilter").click(function() {
      var $form = $("#formFilter");
      $form.trigger("reset");
      $form.validate().resetForm();
      $form.find(".error").removeClass("error");
    });

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
  }); // end filter

  dTable = $("#lookup").dataTable({
    autoWidth: true,
    scrollX: true,
    responsive: true,
    serverSide: true,
    processing: true,
    ordering: false,
    lengthChange: true,
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
      url: host + "/app/api/konsolidasi/ajax.php",
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
  }); // end datatable

  //search proses
  $("#btnSubmitFilter").on("click", function(e) {
    e.preventDefault();
    dTable.api().ajax.reload();
  });
  // $("#formFilter").validate({
  //   submitHandler: function(form) {
  //     ajaxAction();
  //   }
  // });
  //end search proses
});

function ajaxAction() {
  data = $("#formFilter").serializeArray();
  dTable = $("#lookup").dataTable();

  v_dump = $.ajax({
    url: host + "/app/api/konsolidasi/ajax.php",
    data: data,
    dataType: "json",
    success: function(data) {
      $("#filterModel").modal("hide");
    }
  });
  console.log(v_dump);
}

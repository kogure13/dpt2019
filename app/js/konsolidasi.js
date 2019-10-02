var pka;
var pkb;
var pkc;
var pp;

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
        aTargets: [4, 5],
        className: "text-center"
      }
    ],
    ajax: {
      url: host + "/app/api/konsolidasi/ajax.php",
      type: "post",
      data: function(data) {
        data.action = $("#action").val();
        data.kode_provinsi = $("#kode_provinsi").val();
        data.kode_kabkota = $("#kode_kabkota").val();
        data.kode_kecamatan = $("#kode_kecamatan").val();
        data.kode_kelurahan = $("#kode_kelurahan").val();
        data.tps = $("#selectTPS").val();
        data.tipe_pemilih = $("#tipe_pemilih").val();
        data.memilih = $("#memilih").val();
        data.kontak = $("#kontak").val();
      }
    }
  }); // end datatable

  //search proses
  $("#btnSubmitFilter").on("click", function(e) {
    e.preventDefault();
    data = $("#formFilter").serializeArray();
    $("#filterModel").modal("hide");
    // dTable.api().ajax.reload();
    dTable.fnDraw();
    tdyd = $.ajax({
      url: host + "/app/api/konsolidasi/ajax.php?action=countKonsolidasi",
      type: "post",
      dataType: "json",
      data: data,
      success: function(data) {
        $("#tdyd").html(data.konsolidasi);
      }
    }); //tdyd
    kategori = $.ajax({
      url: host + "/app/api/konsolidasi/ajax.php?action=countKategori",
      type: "post",
      dataType: "json",
      data: data,
      success: function(data) {
        pka = $("#pka").html(data[0]);
        pkb = $("#pkb").html(data[1]);
        pkc = $("#pkc").html(data[2]);
        $("#pkd").html(data[3]);
        $("#pke").html(data[4]);
        pp = data[0]+data[1]+data[2];
        $("#pp").html(pp)
      }
    });
  });
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
}

var pka;
var pkb;
var pkc;
var pp;

$(function () {
  $("#btnCetakKonsolidasi").attr("disabled", true);

  $("#filter").on("click", function (e) {
    e.preventDefault();
    $("#filterModel").modal({
      backdrop: "static",
      keyboard: false
    });
    $("#modalTitle").html("Filter Konsolidasi");
    $("#btnCancelFilter").click(function () {
      var $form = $("#formFilter");
      $form.trigger("reset");
      $form.validate().resetForm();
      $form.find(".error").removeClass("error");
    });

    $("#idPilihFilter").change(function (e) {
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
      data: function (data) {
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
  $("#btnSubmitFilter").on("click", function (e) {
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
      success: function (data) {
        $("#tdyd").html(data.konsolidasi);
      }
    }); //tdyd
    kategori = $.ajax({
      url: host + "/app/api/konsolidasi/ajax.php?action=countKategori",
      type: "post",
      dataType: "json",
      data: data,
      success: function (data) {
        pka = $("#pka").html(data[0]);
        pkb = $("#pkb").html(data[1]);
        pkc = $("#pkc").html(data[2]);
        $("#pkd").html(data[3]);
        $("#pke").html(data[4]);
        pp = parseInt(data[0]) + parseInt(data[1]) + parseInt(data[2]);
        $("#pp").html(pp);
      }
    });
  });
  //end search proses

  $("#btnCetakKonsolidasi").on("click", function () {
    $form = $("#formFilter");
    data = $form.serializeArray();

    var kode_filter = 0;
    var kode_tps = 0;
    var memilih = 0;
    var tipe_pemilih = 0;
    var kontak = "";
    console.log(data)
    if ($("#kode_provinsi").val() !== 0) {
      kode_filter = $("#kode_provinsi").val();
    }
    if ($("#kode_kabkota").val() !== 0) {
      kode_filter = $("#kode_kabkota").val();
    }
    if ($("#kode_kecamatan").val() !== 0) {
      kode_filter = $("#kode_kecamatan").val();
    }
    if ($("#kode_kelurahan").val() !== 0) {
      kode_filter = $("#kode_kelurahan").val();
    }
    if ($("#selectTPS").val() !== 0) {
      kode_tps = $("#selectTPS").val();
    }
    if ($("#memilih").val() !== 0) {
      memilih = $("#memilih").val();
    }
    if ($("#tipe_pemilih").val() !== 0) {
      tipe_pemilih = $("#tipe_pemilih").val();
    }
    if ($("#kontak") !== "all") {
      kontak = $("#kontak").val();
    }

    window.open(host + "/app/views/print_konsolidasi.php?kode_filter=" + kode_filter +
      "&kode_tps=" + kode_tps + "&memilih=" + memilih + "&tipe_pemilih=" + tipe_pemilih +
      "&kontak=" + kontak, "_blank");
  });
});

function ajaxAction() {
  data = $("#formFilter").serializeArray();
  dTable = $("#lookup").DataTable();

  v_dump = $.ajax({
    url: host + "/app/api/konsolidasi/ajax.php",
    data: data,
    dataType: "json",
    success: function (data) {
      $("#filterModel").modal("hide");
    }
  });
}

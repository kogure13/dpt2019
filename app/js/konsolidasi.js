var pka;
var pkb;
var pkc;
var pp;
var kategori;
var html_kode_filter = $(".kode-filter");
var kode_filter = "";
var kode_tps = 0;
var memilih = 0;
var tipe_pemilih = 0;
var kontak = "";

$(function() {
  $("#btnCetakKonsolidasi").attr("disabled", true);

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
    lengthChange: false,
    ordering: false,
    pageLength: 20,
    processing: true,
    responsive: true,
    scrollX: true,
    serverSide: true,
    searching: false,
    
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
    },
    fnDrawCallback: function(oSettings) {
      $(".modalAct").on("change", function(e) {
        e.preventDefault();
        var com = $(this).val();
        var id = $(this)
          .find(":selected")
          .attr("data-id");

        if (com === "edit") {
          // alert("OK, Edit!!");
          $("#interviewModel").modal({
            backdrop: "static",
            keyboard: false
          });

          $("#modalTitleInterView").html("Form Kuisioner");
          $("#actionInterview").val("edit");
          $("#kodePemilih").val(id);

          $.ajax({
            url:
              host +
              "/app/api/konsolidasi/ajax.php?id=" +
              id +
              "&action=updateInterview",
            type: "post",
            dataType: "json",
            success: function(data) {
              $("#itipe_pemilih").val(data.id_tipe_pemilih);
              $("#imemilih").val(data.id_pilihan);
              $("#ibanyak_pemilih").val(data.banyak_pemilih);
              $("#ikontak").val(data.nomor_kontak);

              $("#btnSubmitInterview").html("Update");
            }
          });
        } else if (com === "hapus") {
          var conf = confirm("Yakin hapus data ini ?");
          if (conf) {
            $.post(
              host + "/app/api/konsolidasi/ajax.php",
              {
                id: id,
                action: com
              },
              function() {
                $("#lookup")
                  .DataTable()
                  .ajax.reload();
              }
            );
          }
        }
      });
    }
  }); // end datatable

  //search proses
  $("#btnSubmitFilter").on("click", function(e) {
    e.preventDefault();
    data = $("#formFilter").serializeArray();
    $("#filterModel").modal("hide");
    // dTable.api().ajax.reload();
    dTable.fnDraw();
    loadKategori();
    kodeFilter();
  });
  //end search proses

  //tambah pertanyaan
  $("#btnAddInterview").click(function(e) {
    e.preventDefault();
    var div = $(document.createElement("div"))
      .attr("id", "pertanyaan" + a)
      .attr("class", "clearClose");
    var pertanyaan = '<div class="row"><div class="col-sm-6 col-xs-6">';
    pertanyaan +=
      '<input type="text" placeholder="Pertanyaan" name="pertanyaan[]" class="form-control">';
    pertanyaan += "</div>";

    var jawaban = '<div class="col-sm-6 col-xs-6">';
    jawaban +=
      '<div class="input-group"><input type="text" name="jawaban[]" placeholder="Jawaban" class="form-control">';
    var tombol =
      '<div class="input-group-btn"><a href="#" class="btn btn-danger" onclick="hapus(' +
      a +
      ')">';
    tombol += '<i class="fa fa-times fa-fw"></i></a></div></div></div></div>';

    div.after().html(pertanyaan + jawaban + tombol);
    div.appendTo("#qa");
    a++;
  });

  $("#btnCancelInterview").click(function() {
    var $form = $("#formInterview");
    $form.trigger("reset");
    $form.validate().resetForm();
    $form.find(".error").removeClass("error");
  });
  //end tambah pertanyaan

  $("#formInterview").validate({
    rules: {
      memilih: {
        required: true
      },
      tipe_pemilih: {
        required: true
      }
    },
    messages: {},
    submitHandler: function(form) {
      ajaxActionUpdate();
    }
  });
  //end update

  $("#btnCetakKonsolidasi").on("click", function() {
    $form = $("#formFilter");
    data = $form.serializeArray();
    // console.log(data);

    kodeFilter();

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

    window.open(
      host +
        "/app/views/print_konsolidasi.php?kode_filter=" +
        kode_filter +
        "&kode_tps=" +
        kode_tps +
        "&memilih=" +
        memilih +
        "&tipe_pemilih=" +
        tipe_pemilih +
        "&kontak=" +
        kontak,
      "_blank"
    );
  });
});
//End Proses Cetak
function hapus(id) {
  $("#pertanyaan" + id).remove();
}

function ajaxAction() {
  data = $("#formFilter").serializeArray();
  dTable = $("#lookup").DataTable();

  v_dump = $.ajax({
    url: host + "/app/api/konsolidasi/ajax.php",
    data: data,
    dataType: "json",
    success: function(data) {
      $("#filterModel").modal("hide");
    }
  });
}

function ajaxActionUpdate() {
  data = $("#formInterview").serializeArray();
  table = $("#lookup").DataTable();

  $.ajax({
    url: host + "/app/api/konsolidasi/ajax.php",
    data: data,
    tyoe: "post",
    success: function(data) {
      $("#interviewModel").modal("hide");
      // let rekapdiv = $("#rekap").empty();
      table.ajax.reload();
      loadKategori();
    }
  });
}

function loadKategori() {
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
      pp = parseInt(data[0]) + parseInt(data[1]) + parseInt(data[2]);
      $("#pp").html(pp);
    }
  });
}

function kodeFilter() {
  if ($("#kode_provinsi").val() !== "") {
    kode_filter = $("#kode_provinsi").val();
    html_kode_filter.attr("name", "kode_filter");
    html_kode_filter.attr("value", kode_filter);
  }
  if ($("#kode_kabkota").val() !== "") {
    kode_filter = $("#kode_kabkota").val();
    html_kode_filter.attr("name", "kode_filter");
    html_kode_filter.attr("value", kode_filter);
  }
  if ($("#kode_kecamatan").val() !== "") {
    kode_filter = $("#kode_kecamatan").val();
    html_kode_filter.attr("name", "kode_filter");
    html_kode_filter.attr("value", kode_filter);
  }
  if ($("#kode_kelurahan").val() !== "") {
    kode_filter = $("#kode_kelurahan").val();
    html_kode_filter.attr("name", "kode_filter");
    html_kode_filter.attr("value", kode_filter);
  }

  return kode_filter;
}

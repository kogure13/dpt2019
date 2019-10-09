$(function() {
  setInputFilter(document.getElementById("kontak"), function (value) {
    return /^\d*$/.test(value);
  });
  setInputFilter(document.getElementById("banyak_pemilih"), function (value) {
    return /^\d*$/.test(value);
  });
  //clear
  $("input").attr("autocomplete", "off");

  $(".btnCari").attr("disabled", true);
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

  // dataTable
  var dTable = $("#lookup").dataTable({
    autoWidth: true,
    scrollX: true,
    responsive: true,
    serverSide: true,
    processing: true,
    ordering: false,
    searching: false,
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
        aTargets: [0, 5],
        className: "text-center"
      }
    ],
    ajax: {
      url: host + "/app/api/dpt/ajax.php",
      type: "post",
      data: function(data) {
        data.kode_provinsi = $("#kode_provinsi").val();
        data.kode_kabkota = $("#kode_kabkota").val();
        data.kode_kecamatan = $("#kode_kecamatan").val();
        data.kode_kelurahan = $("#kode_kelurahan").val();
        data.niknama = $("#niknama").val();
        data.tps = $("#selectTPS").val();
        data.action = $("#action").val();
        // console.log(data);
      }
    },
    fnDrawCallback: function(oSettings) {
      $(".modalAct").on("change", function(e) {
        e.preventDefault();
        var com = $(this).val();
        var id = $(this)
          .find(":selected")
          .attr("data-id");

        if (com === "interview") {
          $("#interviewModel").modal({
            backdrop: "static",
            keyboard: false
          });

          $("#modalTitleInterView").html("Form Kuisioner");
          $("#actionInterview").val("interview");
          $("#kodePemilih").val(id);
        } else if (com === "edit") {
        }
      });
    }
  });
  //end datatable

  //search proses
  $("#btnCari").on("click", function(e) {
    e.preventDefault();
    dTable.api().ajax.reload();
  });
  //end search

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

  $("#btnCancelInterview").click(function () {
    var $form = $("#formInterview");
    $form.trigger("reset");
    $form.validate().resetForm();
    $form.find(".error").removeClass("error");
  });
  //end tambah pertanyaan

  //submit proses
  // $("#formInterview").on("click", function(e) {
  //   data = $("#formInterview").serializeArray();

  //   dump = $.ajax({
  //     url: host + "/app/api/dpt/ajax.php?action=interview",
  //     type: "post",
  //     dataType: "json",
  //     data: data,
  //     success: function(data) {
  //       $("#interviewModel").modal("hide");
  //       $("#formInterview").trigger("reset");
  //       $("select").val("");
  //       dTable.ajax.reload();
  //     }
  //   });
  // });
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
      ajaxAction();
    }
  });
  //end submit proses

  //Cetak proses
  $("#btnCetakDPT").on("click", function(e){
    alert("cetak bro");

  });
});

function hapus(id) {
  $("#pertanyaan" + id).remove();
}

function ajaxAction() {
  data = $("#formInterview").serializeArray();
  table = $("#lookup").DataTable();

  var v_dump = $.ajax({
    url: host + "/app/api/dpt/ajax.php",
    type: "post",
    dataType: "json",
    data: data,
    success: function(data, response) {
      $("#interviewModel").modal("hide");
      $("select").val("");
      alert("Interview Saved!!");
      table.ajax.reload();
    },
    error: function(text) {
      alert("error, system");
    }
  });
}

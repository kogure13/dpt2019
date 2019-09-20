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
          $("#idPemilih").val(id);
        } else if (com === "edit") {
        }
      });
    }
  });
  //end datatable

  //search proses
  var dump = $(".btnCari").on("click", function(e) {
    e.preventDefault();
    dTable.api().ajax.reload();
  });
  //end search

  //tambah pertanyaan
  $("#btnAddInterview").click(function(e) {
    e.preventDefault();
    var div = $(document.createElement("div"))
      .attr("id", "pertanyaan" + a)
      .attr("class", "form-group clearClose");
    var pertanyaan = '<div class="col-sm-6 col-xs-6">';
    pertanyaan +=
      '<input type="text" placeholder="Pertanyaan" name="pertanyaan[]" class="form-control">';
    pertanyaan += "</div>";
    var jawaban = '<div class="col-sm-6 col-xs-6">';
    jawaban +=
      '<div class="input-group"><input type="text" name="jawaban[]" placeholder="Jawaban" class="form-control">';
    var tombol =
      '<div class="input-group-btn"><a href="#" class="btn btn-sm btn-danger bg-red-active" onclick="hapus(' +
      a +
      ')">';
    tombol += '<i class="fa fa-trash fa-fw "></i></a></div></div></div>';

    div.after().html(pertanyaan + jawaban + tombol);
    div.appendTo("#qa");
    a++;
  });
  //end tambah pertanyaan
});

function hapus(id) {
  $("#pertanyaan" + id).remove();
}

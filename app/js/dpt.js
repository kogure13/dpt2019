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
  $("#lookup").dataTable({
    responsive: true,
    language: {
      sSearch: "_INPUT_",
      sSearchPlaceholder: "Search...",
      sLengthMenu: "_MENU_"
    },
    aoColumnDefs: [{ aTargets: ["nosort"], bSortable: false }]
  });
  //end datatable

  //search proses
  $("#btnCari").on("click", function(e) {
    e.preventDefault();
    items_prov =  $("#tags_provinsi").val();
    items_kabkota = $("#tags_kabkota").val();
    items_kecamatan = $("tags_kecamatan").val();
    items_kelurahan = $("tags_kelurahan").val();
    var tps = $("#selectTPS").val();
    var niknama = $("#niknama").val();

    if(items_prov === "" || items_kabkota === "" || items_kecamatan === "" || items_kelurahan === "") {
      alert("Please field it");
    }
    if(tps === "") {
      alert("empty TPS, please pick one");
    }
    if(niknama === "") {
      alert("empty NIK/NAMA, please field it");
    }
  });
});

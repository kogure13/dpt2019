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
    $tps = $("#selectTPS").val();
    $niknama = $("#niknama").val();
  });
});

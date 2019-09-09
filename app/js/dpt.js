var pilihFilter;

$(function() {
  var dump = $("#idPilihFilter").change(function(e) {
    e.preventDefault();
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
});

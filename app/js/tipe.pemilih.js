$(function() {
  var dTable = $("#lookup").DataTable({
    height: "100%",
    width: "100%",
    dom: "Bfrtip",
    buttons: [
      {
        text: "<i class='fa fa-plus'></i> Add Items",
        action: function(e, dt, node, config) {
          openModal("add", "Tambah Menu");
        },
        className: "btn btn-sm btn-success bg-green",
        init: function(api, node, config) {
          $(node).removeClass("dt-button");
        }
      }
    ],
    language: {
      sSearch: "_INPUT_",
      sSearchPlaceholder: "Search...",
      sLengthMenu: "_MENU_"
    },
    info: false,
    lengthChange: false,
    pageLength: 20    
  });
});

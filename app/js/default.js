var host = window.origin;
// console.log(host)
var pilihFilter;
var items_prov;
var items_kabkota;
var items_kecamatan;
var items_kelurahan;
var items_tps;

$(function () {

  $("#tags_kelurahan").autocomplete({
    source: host + "/app/api/kelurahan/tags_kelurahan.php",
    select: function (event, ui) {
      $("#tags_kelurahan").val(ui.item.value);
      $("#id_kelurahan").val(ui.item.id);
      id = $("#id_kelurahan").val();
      letDropDown(id, "kelurahan");

      return false;
    },
    minLength: 3
  });

  $("#tags_kecamatan").autocomplete({
    source: host + "/app/api/kecamatan/tags_kecamatan.php",
    select: function (event, ui) {
      $("#tags_kecamatan").val(ui.item.value);
      $("#id_kecamatan").val(ui.item.id);
      id = $("#id_kecamatan").val();
      letDropDown(id, "kecamatan");

      return false;
    },
    minLength: 3
  });

  $("#tags_kabkota").autocomplete({
    source: host + "/app/api/kabkota/tags_kabkota.php",
    select: function (event, ui) {
      $("#tags_kabkota").val(ui.item.value);
      $("#id_kabkota").val(ui.item.id);
      id = $("#id_kabkota").val();
      letDropDown(id, "kabkota");

      return false;
    },
    minLength: 3
  });

  $("#tags_provinsi").autocomplete({
    source: host + "/app/api/provinsi/tags_provinsi.php",
    select: function (event, ui) {
      $("#tags_provinsi").val(ui.item.value);
      $("#id_provinsi").val(ui.item.id);
      id = $("#id_provinsi").val();
      letDropDown(id, "provinsi");

      return false;
    },
    minLength: 3
  });
});

function numberFormat(number) {
  var reverse = number
    .toString()
    .split("")
    .reverse()
    .join(""),
    ribuan = reverse.match(/\d{1,3}/g);
  ribuan = ribuan
    .join(".")
    .split("")
    .reverse()
    .join("");

  return ribuan;
}

function letDropDown(id, filter) {
  let dropdown_tags = $("#selectTPS");
  dropdown_tags.empty();
  dropdown_tags.append('<option selected="true" disabled>TPSS</option>');

  $.getJSON(
    host + "/app/api/dpt/ajax.php?action=getTPS&filter=" + filter + "&id=" + id,
    function (data) {
      $.each(data, function (key, entry) {
        dropdown_tags.append(
          $("<option></option>")
            .attr("value", entry.id)
            .text(entry.nama)
        );
      });
    }
  );
}

setInterval(function sendReq() {
  $.ajax({
    url: host + "/app/api/ping.php"
  })
}, 300000);

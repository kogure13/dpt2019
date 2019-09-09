var host = window.origin;
// console.log(host)
$(function() {
  $("#tags_kelurahan").autocomplete({
    source: host + "/app/api/kelurahan/tags_kelurahan.php",
    select: function(event, ui) {
      $("#tags_kelurahan").val(ui.item.value);
      $("#id_kelurahan").val(ui.item.id);

      return false;
    },
    minLength: 3
  });

  $("#tags_kecamatan").autocomplete({
    source: host + "/app/api/kecamatan/tags_kecamatan.php",
    select: function(event, ui) {
      $("#tags_kecamatan").val(ui.item.value);
      $("#id_kecamatan").val(ui.item.id);

      return false;
    },
    minLength: 3
  });

  $("#tags_kabkota").autocomplete({
    source: host + "/app/api/kabkota/tags_kabkota.php",
    select: function(event, ui) {
      $("#tags_kbakota").val(ui.item.value);
      $("#id_kabkota").val(ui.item.id);

      return false;
    },
    minLength: 3
  });

  $("#tags_provinsi").autocomplete({
    source: host + "/app/api/provinsi/tags_provinsi.php",
    select: function(event, ui) {
      $("#tags_provinsi").val(ui.item.value);
      $("#id_provinsi").val(ui.item.id);

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

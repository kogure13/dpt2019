$(function() {
  $("#tags_kecamatan").autocomplete({
    source: host + "/app/api/kecamatan/tags_kecamatan.php",
    select: function(event, ui) {
      $("#tags_kecamatan").val(ui.item.value);
      $("#id_kecamatan").val(ui.item.id);

      return false;
    },
    minLength: 3
  });
});

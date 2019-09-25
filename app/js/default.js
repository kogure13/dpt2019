var host = window.origin;
var pilihFilter;
var items_prov;
var items_kabkota;
var items_kecamatan;
var items_kelurahan;
var items_tps;

var a = 4;

$(function() {
  // sendReq();

  $("#tags_kelurahan").autocomplete({
    source: host + "/app/api/kelurahan/tags_kelurahan.php",
    select: function(event, ui) {
      $("#tags_kelurahan").val(ui.item.value);
      $("#id_kelurahan").val(ui.item.id);
      $("#kode_kelurahan").val(ui.item.kode);
      id = $("#id_kelurahan").val();
      letDropDown(id, "kelurahan");

      return false;
    },
    minLength: 3
  });

  $("#tags_kecamatan").autocomplete({
    source: host + "/app/api/kecamatan/tags_kecamatan.php",
    select: function(event, ui) {
      $("#tags_kecamatan").val(ui.item.value);
      $("#id_kecamatan").val(ui.item.id);
      $("#kode_kecamatan").val(ui.item.kode);
      id = $("#id_kecamatan").val();
      letDropDown(id, "kecamatan");

      return false;
    },
    minLength: 3
  });

  $("#tags_kabkota").autocomplete({
    source: host + "/app/api/kabkota/tags_kabkota.php",
    select: function(event, ui) {
      $("#tags_kabkota").val(ui.item.value);
      $("#id_kabkota").val(ui.item.id);
      $("#kode_kabkota").val(ui.item.kode);
      id = $("#id_kabkota").val();
      letDropDown(id, "kabkota");

      return false;
    },
    minLength: 3
  });

  $("#tags_provinsi").autocomplete({
    source: host + "/app/api/provinsi/tags_provinsi.php",
    select: function(event, ui) {
      $("#tags_provinsi").val(ui.item.value);
      $("#id_provinsi").val(ui.item.id);
      $("#kode_provinsi").val(ui.item.kode);
      id = $("#id_provinsi").val();
      letDropDown(id, "provinsi");

      return false;
    },
    minLength: 3
  });
  //end autocomplete

  let dropdown_memilih = $(".memilih");
  dropdown_memilih.empty();
  dropdown_memilih.append(
    '<option selected="true" disabled>Pilihan Anda di Pileg</option>'
  );

  let dropdown_tipe = $(".tipe");
  dropdown_tipe.empty();
  dropdown_tipe.append(
    '<option selected="true" disabled>Tipe Pemilih</option>'
  );

  v_memilih = $.getJSON(host + "/app/api/dpt/ajax.php?action=pileg", function(data) {
    $.each(data, function(key, entry) {
      dropdown_memilih.append(
        $("<option></option>")
          .attr("value", entry.id_pilihan)
          .text(entry.kode_pilihan + ". " + entry.nama_pilihan)
      );
    });
  });

  v_tipe = $.getJSON(host + "/app/api/dpt/ajax.php?action=tipe", function(data) {
    $.each(data, function(key, entry) {
      dropdown_tipe.append(
        $("<option></option>")
          .attr("value", entry.id_tipe)
          .text(entry.id_tipe + ". " + entry.nama_tipe)
      );
    });
  });
  //end dropdown pilihan
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
  dropdown_tags.append("<option value>TPS</option>");

  $.getJSON(
    host + "/app/api/dpt/ajax.php?action=getTPS&filter=" + filter + "&id=" + id,
    function(data) {
      $.each(data, function(key, entry) {
        dropdown_tags.append(
          $("<option></option>")
            .attr("value", entry.id)
            .text(entry.nama)
        );
      });
    }
  );
}

// function sendReq() {
//   $.ajax({
//     url: host + "/app/api/ping.php",
//     success: function() {
//       //  operation on return value
//       $(".fa-refresh").hide();
//     },
//     complete: function(data) {
//       setTimeout(sendReq, 300000);
//     }
//   });
// }

function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
    textbox.addEventListener(event, function () {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  });
}
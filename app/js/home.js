var url = host + "/app/api/home/ajax.php";

$(document).ready(function() {
  $.ajax({
    url: url + "?action=getDPT&tbname=dashboard",
    type: "post",
    dataType: "json",
    success: function(data) {
      // console.log(data)
      $("#dpt").html(numberFormat(data.dpt));
      $("#dptl").html(numberFormat(data.dpt_laki_laki));
      $("#dptp").html(numberFormat(data.dpt_perempuan));
      $("#tps").html(numberFormat(data.tps));
      $("#provinsi").html(numberFormat(data.provinsi));
      $("#kota").html(numberFormat(data.kabupaten_kota));
      $("#kecamatan").html(numberFormat(data.kecamatan));
      $("#kelurahan").html(numberFormat(data.kelurahan));
    }
  });
});

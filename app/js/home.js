var url = host + "/app/api/home/ajax.php";
var load = host + "/app/views/";

$(document).ready(function() {
  $(".infoAct").on("click", function(e) {
    e.preventDefault();
    var id = $(this).attr("id");
    loadStatistik = load + "statistik." + id + ".php";
    $(".box-statistik").load(loadStatistik, function() {
      $(".namaAct").on("click", function(e) {
        e.preventDefault();
        var dataid = $(this).attr("data-id");
        console.log(dataid)
      });
    });
    // console.log(loadStatistik)
  });

  // ajax load data
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
      // just load statistik provinsi
      $(".box-statistik").load(load + "statistik.provinsi.php");
    }
  });
});

var url = host + "/app/api/home/ajax.php";
var load = host + "/app/views/";

$(document).ready(function() {

  var table = $(".statistik").DataTable();
  com = $(".statistik tbody").on("click", "tr", function(){
    var data = table.row(this).data();
    alert("Data click is "+data[0]);
  });

  $(".infoAct").on("click", function(e) {
    e.preventDefault();
    var id = $(this).attr("id");
    loadStatistik = load + "statistik." + id + ".php";

    $(".box-statistik").load(loadStatistik, function() {
      statistikTable();
      
      $(".namaAct").on("click", function(e) {
        e.preventDefault();
        var dataid = $(this).attr("data-id");
        $(".box-statistik").load(loadStatistik, function(){
          statistikTable();
          
        });
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
      $(".box-statistik").load(load + "statistik.provinsi.php", function() {
        statistikTable();
        $(".namaAct").on("click", function(e) {
          e.preventDefault();
          var dataid = $(this).attr("data-id");
          //load to kabupaten kota
          loadStatistik = load + "statistik.kabkota.php?id=" + dataid;
          $(".box-statistik").load(loadStatistik, function() {
            statistikTable();
            $(".namaAct").on("click", function(e){
              e.preventDefault();
              var dataid = $(this).attr("data-id");
              //load to kecamatan
              loadStatistik = load + "statistik.kecamatan.php?id=" + dataid;
              $(".box-statistik").load(loadStatistik, function(){
                statistikTable();
                $(".namaAct").on("click", function(e){
                  e.preventDefault();
                  var dataid = $(this).attr("data-id");
                  //load to kelurahan
                  loadStatistik = load+"statistik.kelurahan.php?id="+dataid;
                  $(".box-statistik").load(loadStatistik, function(){
                    statistikTable();                    
                  });
                });
              });
            });
          });
        });
      });
    }
  });
  //list table
});

function statistikTable() {
  $(".statistik").dataTable({
    scrollX: true,
    autoWidth: true,
    pageLength: 50,
    ordering: false,
    lengthChange: false,
    searching: false,
    paging: false,
    info: false
  });
}

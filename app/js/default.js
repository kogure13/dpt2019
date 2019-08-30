var host = window.origin;
// console.log(host)
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
  

function numberFormat(number){
    var	reverse = number.toString().split('').reverse().join(''),
	ribuan 	= reverse.match(/\d{1,3}/g);
    ribuan	= ribuan.join('.').split('').reverse().join('');
    
    return ribuan;
}
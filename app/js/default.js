var host = window.origin;
// console.log(host)

function numberFormat(number){
    var	reverse = number.toString().split('').reverse().join(''),
	ribuan 	= reverse.match(/\d{1,3}/g);
    ribuan	= ribuan.join('.').split('').reverse().join('');
    
    return ribuan;
}
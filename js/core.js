var monthNames = [ "January", "February", "March", "April", "May", "June",
"July", "August", "September", "October", "November", "December" ];
var dayNames= ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"]
var newDate = new Date();
newDate.setDate(newDate.getDate() + 1);    
$('#Date').html(dayNames[newDate.getDay()] + ", " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());


if ((".loader").length) {
  // show Preloader until the website ist loaded
  $(window).on('load', function () {
  	$(".loader").fadeOut("slow");
  });
}

function rp(nom) {
	nm = isNaN(parseFloat(nom))?0:parseFloat(nom);
	if (nm==0) {
		return "0";
	} else {
		nm = nm.toLocaleString('id-ID', {minimumFractionDigits: 2});
		ex = nm.split(",");
		if (ex[1]=="00") {
			return ex[0];
		} else {
			return nm;
		}
	}
}
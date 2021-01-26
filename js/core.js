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

$(document).ready(function() {
	getData();
})

$('#btnreg').click(function() {
	$('#mreg_loading').show();
    var formdata = new FormData($('#mregister form')[0]);
	$.ajax({
		url: 'home/register',
		type: 'POST',
		dataType: 'json',
		data: formdata,
		processData: false,
		contentType: false,
	})
	.done(function(data) {
		$('#mreg_loading').hide();
		alert(data.msg);
		if (data.status==200) {
			$('#mregister').modal('hide');
		}
	})
	.fail(function(e) {
		$('#mreg_loading').hide();
		console.log("error");
	});
});

$('#btnlogin').click(function() {  
	// if($("#mlogin form").validate()){      
	    var formdata = new FormData($('#mlogin form')[0]);
		$.ajax({
			url: 'home/login',
			type: 'POST',
			dataType: 'json',
			data: formdata,
			processData: false,
			contentType: false
		})
		.done(function(data) {
			$('#mreg_loading').hide();
			alert(data.msg);
			if (data.status==200) {
				$('#mregister').modal('hide');
				location.reload();
			}
		})
		.fail(function(e) {
			console.log(e);
		});
	// }
});
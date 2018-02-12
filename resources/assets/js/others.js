
//enable tooltips
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip({container: 'body'}); 
});

//enable modal
$('#flash-overlay-modal').modal();

//display flash messages
$('div.alert').not('.alert-important').delay(3000).fadeOut(2000);



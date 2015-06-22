$(document).ready(function() {
 $.ajax({});
	$('#postwall').unbind().click(function() {
		$('.media-list').prepend('<div class="media-content">'+$("#writeup").val()+'</div>');
	});
});


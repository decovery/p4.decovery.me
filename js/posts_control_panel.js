$.ajax({
	type: 'POST',
	url: '/control_panel/refresh/',
	success: function(response) { 
	
	
	var data = $.parseJSON(response);
	
	// Inject the data into the page
	$('#post_count').html(data['post_count']);
	$('#user_count').html(data['user_count']);
	$('#most_recent_post').html(data['most_recent_post']);
	
	if (data['image'] == 'Invalid file type.') {
		$('#image').html(' ');
	}
	else {
		$('#image').attr("src", '/uploads/covers/' + data['image']);
	}
	
	},
});

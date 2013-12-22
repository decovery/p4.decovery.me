var options = {
	type: 'POST',
	url: '/posts/p_add',
	beforeSubmit: function() {
		$('#results').html('Adding...');
	},
	success: function(response) {
		$('#results').html(response);
	}
};


$('form').ajaxForm(options);
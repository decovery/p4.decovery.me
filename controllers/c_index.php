<?php

class index_controller extends base_controller {
	
	public function __construct() {
		parent::__construct();
	} 
		
	public function index() {
		
		# Template with a view file
		$this->template->content = View::instance('v_index_index');
			
		# <title> tag
		$this->template->title = "BookTalk";
		
		# JavaScript files
	    $client_files_body = Array(
	        '/js/posts_control_panel.js',
	        '/js/validate.js');
	    $this->template->client_files_body = Utils::load_client_files($client_files_body);
	    		
		# Pass the login module
		$this->template->content->login = View::instance('v_users_login');
		
		# Pass the signup module
		$this->template->content->signup = View::instance('v_users_signup');
		
		# Pass the login module
		$this->template->content->control_panel = View::instance('v_control_panel_index');
						     		
		# Render the view
		echo $this->template;      					     		

	} # End of method
	
	
} # End of class

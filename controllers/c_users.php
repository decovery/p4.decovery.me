<?php
class users_controller extends base_controller {

	public function __construct() {
    	parent::__construct();
    } 

    public function index() {
    
    	# Setup view
    	$this->template->content = View::instance('v_users_view_all');
    	$this->template->title = "Users";
    	
       	# Select all users from database
       	$view_users = DB::instance(DB_NAME)->select_rows('SELECT * FROM users');
    
    	# Pass data to the view
		$this->template->content->view_users = $view_users;
    	
    	# Render template
    	echo $this->template;
    }

    public function signup($error = NULL) {
    
    	# Setup view
       	$this->template->content = View::instance('v_users_signup');
        $this->template->title   = "Sign Up";
        
        # JavaScript files
        $client_files_body = Array(
            '/js/validate.js');
        $this->template->client_files_body = Utils::load_client_files($client_files_body);
       	
       	# Pass errors
       	$this->template->content->error = $error;
	
		# Render template
		echo $this->template;
    }
    
    public function p_signup() {

		# Error checking: check if email already exists
		$q = "SELECT email FROM users WHERE email = '" . $_POST['email'] . "'";
		
		$email = DB::instance(DB_NAME)->select_field($q);
				
		# Prevent from leaving blank fields		
		if (empty($_POST['last_name']) || empty($_POST['first_name']) || empty($_POST['password']) || empty($_POST['email'])) {
				
			# Display error message
			Router::redirect("/users/signup/error");
		}
		
		elseif (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_POST["email"])) {
			
			# Display error message
			Router::redirect("/users/signup/error");
		}
		
		# Die if email already exists
		elseif ($email) {
			
			die("Email already exists! <a href='/users/signup/'>Back</a>");
		}
		
		# If all fields are filled and email is unique, process signup
		else {
			
			# More data we want stored with the user
			$_POST['created']  = Time::now();
			$_POST['modified'] = Time::now();
			
			# Encrypt the password  
			$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
			
			# Create an encrypted token via their email address and a random string
			$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
			
			# Create default avatar
			$_POST['avatar'] = 'example.jpg';
						
			# Insert this user into the database
			$user_id = DB::instance(DB_NAME)->insert('users', $_POST);
			
			$data = Array(
				"created" => Time::now(),
				"user_id" => $user_id,
				"user_id_followed" => $user_id
			);
			
			# Follow myself
			DB::instance(DB_NAME)->insert('users_users', $data);
			
			# Search the db for this email and password
			# Retrieve the token if it's available
			$k = "SELECT token 
				FROM users 
				WHERE email = '".$_POST['email']."' 
				AND password = '".$_POST['password']."'";
			
			$token = DB::instance(DB_NAME)->select_field($k);
			
			# Store cookie for 4 weeks
			setcookie("token", $token, strtotime('+4 weeks'), '/');
			
			# Redirect to the main page
			Router::redirect("/");
		}		             
	}

    public function login($error = NULL) {
        
		# Setup view
		$this->template->content = View::instance('v_users_login');
		$this->template->title   = "Login";
		
		# JavaScript files
		$client_files_body = Array(
		    '/js/validate.js');
		$this->template->client_files_body = Utils::load_client_files($client_files_body);
		
		# Pass data to the view
		$this->template->content->error = $error;
				        
		# Render template
		echo $this->template;
    }
    
    public function p_login() {
    
		# Sanitize the user entered data to prevent SQL Injection Attacks
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
	
		# Hash submitted password we can compare it against one in the db
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

		# Search the db for this email and password
		# Retrieve the token if it's available
		$q = "SELECT token 
			FROM users 
			WHERE email = '".$_POST['email']."' 
			AND password = '".$_POST['password']."'";
		
		$token = DB::instance(DB_NAME)->select_field($q);
		
		# Login failed
		if(!$token) {
		
			# Dispay error message
			Router::redirect("/users/login/error");
		
		# Login succeeded! 
		} else {
		
			# Store cookie for 4 weeks
			setcookie("token", $token, strtotime('+4 weeks'), '/');
			
			# Redirect to the main page
			Router::redirect("/");
		}
    }
    

    public function logout() {
        
		# Generate and save a new token for next login
		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
        
		# Create the data array we'll use with the update method
		# In this case, we're only updating one field, so our array only has one entry
		$data = Array("token" => $new_token);
        
		# Do the update
		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
        
		# Delete their token cookie by setting it to a date in the past
		setcookie("token", "", strtotime('-1 year'), '/');
        
		# Send them back to the main index.
		Router::redirect("/");
    }

    public function profile() {
    
    	# If user is blank, redirect them to the login page
    	if(!$this->user) {
    		
    		Router::redirect('/users/login');
       	}
    	
    	# If user is logged in:
    	# Setup view
    	$this->template->content = View::instance('v_users_profile');
    	$this->template->title = "Profile of ".$this->user->first_name;
  
  		
  		$avatar = $this->user->avatar;
  		
  		# Pass data to the view
  		$this->template->content->avatar = $avatar;    	     	
    	
    	# Render template
    	echo $this->template;
    }
    
    public function edit_profile() {
    
    	# If user is blank, redirect them to the login page
    	if(!$this->user) {
    		
    		Router::redirect('/users/login');
       	}
    
    	# Setup the view
    	$this->template->content = View::instance('v_users_edit_profile');
    	$this->template->title = "Edit profile of ".$this->user->first_name;
    	
    	$avatar = $this->user->avatar;
    	
    	# Pass data to the view
    	$this->template->content->avatar = $avatar; 
    	    	
    	# Select user's data from the database
 		$q = "SELECT *
 			FROM users 
 			WHERE user_id = ".$this->user->user_id;
 					
 		$this_user = DB::instance(DB_NAME)->select_row($q);
 		
 		# Create new form object and pass form data to the view
 		$this->template->content->form = New Form($this_user);
    	
    	# Render template    	
    	echo $this->template;
    }
    
    public function p_edit_profile() { 
    
    	# Prevent special characters
    	$_POST['bio'] = htmlentities($_POST['bio']);
    
    	# Update users bio information
		$data = Array("bio" => $_POST['bio']);
	   
		DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = ".$this->user->user_id);
	   
		# Redirect to profile page
		Router::redirect("/users/profile");
    
    }
    
    public function upload_avatar() {
    
    	# If user is blank, redirect to the login page
    	if(!$this->user) {
    		
    		Router::redirect('/users/login');
    	}
    
    	# Setup the view
    	$this->template->content = View::instance('v_users_upload_avatar');
    	$this->template->title = "Upload avatar of ".$this->user->first_name;
    	
    	$avatar = $this->user->avatar;
    	
    	# Pass data to the view
    	$this->template->content->avatar = $avatar;
    	
    	# Render template
    	echo $this->template;
    
    }
    
    public function p_upload_avatar() {
   
   		if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
	    	
	    	# Upload avatar picture
	    	$avatar = Upload::upload($_FILES, "/uploads/avatars/", array("jpg", "jpeg", "gif", "png"), $this->user->user_id);
	    	
	    	
	    	$extentions = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	    	if (!in_array($_FILES['avatar']['type'], $extentions)) {
	    		echo "Error! .jpg, .jpeg, .png, .gif images only. Please <a href='/users/upload_avatar/'>try again.</a>";
	    	}
	    	
	    	else {
	    
	       	# Update database
	       	$data = Array("avatar" => $avatar);
	    	
	    	DB::instance(DB_NAME)->update("users", $data, "WHERE  user_id = ".$this->user->user_id);
	    	
	    	# Create new image object and resize it
	    	$imgObj = new Image(APP_PATH.'/uploads/avatars/' .$avatar);
	    	
	    	$imgObj->resize(150,150, "crop");
	    	
	    	$imgObj->save_image(APP_PATH.'/uploads/avatars/' .$avatar);
	    	
	    	# Render template
	    	Router::redirect("/users/profile"); 
	    	}
    	} 
    	
    	else {
    		echo "Error! You haven't chosen any image. Please <a href='/users/upload_avatar/'>try again.</a>";
    	}
	}
    

} # end of class
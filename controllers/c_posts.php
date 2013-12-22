<?php
class posts_controller extends base_controller {

	public function __construct() {
		parent::__construct();
		
		# Not logged in users can't see the posts
		if(!$this->user) {
			Router::redirect("/");
		}
	}
	
	public function index() {
		
		# Setup view
		$this->template->content = View::instance('v_posts_index');
		$this->template->title = "Posts";
		
		# Build the query
		$q = 'SELECT
				posts .*,
				posts.user_id AS post_user_id,
				users_users.user_id AS follower_id,
				users.first_name,
				users.last_name
			FROM posts
			INNER JOIN users_users
				ON posts.user_id = users_users.user_id_followed
			INNER JOIN users
				ON posts.user_id = users.user_id
			WHERE users_users.user_id = '.$this->user->user_id;
		
		# Run query
		$posts = DB::instance(DB_NAME)->select_rows($q);
		
		# Build the query
		$b = 'SELECT 
			    posts .* , 
			    users.first_name, 
			    users.last_name
			FROM posts
			INNER JOIN users 
		    	ON posts.user_id = users.user_id
		    WHERE users.user_id = '.$this->user->user_id;
		
		# Run the query
		$my_posts = DB::instance(DB_NAME)->select_rows($b);
		
		# Pass data to the view
		$this->template->content->my_posts = $my_posts;
		# Pass data to the view
		$this->template->content->posts = $posts;
		
		# Render view
		echo $this->template;
	}

	public function add() {
		
		# Setup view
		$this->template->content = View::instance('v_posts_add');
		$this->template->title = "New post";
		
		$client_files_body = Array(
			'/js/jquery.form.js',
			'/js/posts_add.js'
		);
		
		$this->template->client_files_body = Utils::load_client_files($client_files_body);
		
		# Render template
		echo $this->template;
	}
	
	public function p_add() {
	
		if (empty($_POST['content'])) {
				
			# Display error message
			#Router::redirect("/users/signup/error");
			echo "You must post something. <a href='/posts/add'>Back &rarr;</a>";
		}
		
		else {
		# Associate this post with this user
		$_POST['user_id'] = $this->user->user_id;
		
		# Unix time stamp when this post was created/modified
		$_POST['created'] = Time::now();
		$_POST['modified'] = Time::now();
		
		# Prevent special characters
		$_POST['content'] = htmlentities($_POST['content']);
		$_POST['author'] = htmlentities($_POST['author']);
		$_POST['title'] = htmlentities($_POST['title']);
		
		$file_name = $_POST['title'].'_'.Time::now();
		
		$image = Upload::upload($_FILES, "/uploads/covers/", array("jpg", "jpeg", "gif", "png"), $file_name);
		
		$data = array(
			'user_id' => $this->user->user_id, 
			'created' => Time::now(),
			'modified' => Time::now(),
			'author' => $_POST['author'],
			'title' => $_POST['title'],
			'content' => $_POST['content'],
			'image' => $image);
				
		# Insert post
		DB::instance(DB_NAME)->insert('posts', $data);
		
		# Create new image object and resize it
		$imgObj = new Image(APP_PATH.'/uploads/covers/'.$image);
		
		$imgObj->resize(200, 297, 'crop');
		
		$imgObj->save_image(APP_PATH.'/uploads/covers/'.$image);
			
		$view = new View('v_posts_p_add');
				
		$view->image = $image;
		$view->post = $_POST['content'];
		
		echo $view;
		}
	}
	
	public function users() {
		
		# Setup view
		$this->template->content = View::instance('v_posts_users');
		$this->template->title = "Users";
		
		# Get all users
		$q = "SELECT * FROM users";
		
		# Store the result array in the variable $users
		$users = DB::instance(DB_NAME)->select_rows($q);
		
		# Query of what connections this user have (who are they following)
		$q = "SELECT *
			FROM users_users
			WHERE user_id = ".$this->user->user_id;
	
		# Store the results in variable $connections
		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
		
		# Pass data to the view
		$this->template->content->users = $users;
		$this->template->content->connections = $connections;
		
		# Render template
		echo $this->template;
	}
	
	public function follow($user_id_followed) {
		
		# Prepare the data array to be inserted
		$data = Array(
			"created" => Time::now(),
			"user_id" => $this->user->user_id,
			"user_id_followed" => $user_id_followed
		);
		
		# Insert data
		DB::instance(DB_NAME)->insert('users_users', $data);
		
		# Redirect to the users' list
		Router::redirect("/posts/users");
	}
	
	public function unfollow($user_id_followed) {
	
		# Delete the connection
		$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
		
		# Delete from database
		DB::instance(DB_NAME)->delete('users_users', $where_condition);
		
		# Redirect to users' list
		Router::redirect("/posts/users");
	}

} #eoc
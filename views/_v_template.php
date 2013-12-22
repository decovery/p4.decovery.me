<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<link rel="stylesheet" href="/css/style.css" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
</head>

<body>
	<div id="wrapper">
		<!--Header-->
		<div id="header">
			<h1 id="logo">BOOKTALK</h1>
		
			<!--If user logged in display menu-->
			<?php if($user): ?>
			
				<div id="sign-in">
					<a href='/users/profile'>My Profile</a>
					<a href='/users/logout'>Logout</a>
				</div>
		
			<!-- If user not logged in display menu -->
			<?php else: ?>
			
				<div id="sign-in">
					<a href='/users/signup'>Sign up</a>
					<a href='/users/login'>Log in</a>
				</div>
		
			<?php endif; ?>
		</div>
		<!--End Header-->
		<hr />
		<!--Main menu-->
		<div id='menu'>
		
			<a href='/'>Home</a>
		
			<!-- Menu for users who are logged in -->
			<?php if($user): ?>
			
				<a href='/posts/index'>See members' posts</a>
				<a href='/posts/users'>Follow members</a>
				<a href='/posts/add'>Add posts</a>			
			
			<!-- Menu options for users who are not logged in -->
			<?php else: ?>
			
				<a href='/users'>Our members</a>
			
			<?php endif; ?>
		</div>
		<!--End main menu-->
	
		<div class="content">
			<?php if(isset($content)) echo $content; ?>
		</div>
		<!--End content-->
		<hr />
	</div>
	<!--End wrapper-->
		
	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>
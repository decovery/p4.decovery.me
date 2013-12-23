<!--If not logged in user display sign up and login forms-->
<?php if(!$user): ?>
	<p>BookTalk is a microblog where people can post reviews of the books they have recently read.</p>
	<br/>

	<h1>Welcome to <?=APP_NAME?>!</h1>

	<div id="signup-block">
		<!-- Display the signup module -->
		<?= $signup ?>
	</div>
	
	<i id="or">or</i>
	
	<div id="login-block">
        <!-- Display the login module -->
		<?=$login?>
	</div>

<!--If user logged in display welcome message-->
<?php else: ?>

	<div id="welcome">
		<img src="<?= $user->avatar ?>" alt="<?= $user->first_name ?>" class="avatar">
		<br /><br />
		<h1>Welcome to <?=APP_NAME?><?= ', '.$user->first_name ?></h1>
	</div>
	<!--Display control panel-->
	<div id="control_panel">
		<?= $control_panel ?>
	</div>

<?php endif; ?>
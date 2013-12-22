<!--View users list (for uregistered users - only avatar and name displayed)-->
<h1>List of <?= APP_NAME ?> members.</h1> 

<!--If member is not logged in he/she can see only the names/avatars of members but can't follow them.-->
<?php if(!$user): ?>
	<p><i><?= "If you want to see their posts of follow them, please <a href='/users/signup'>signup</a> or <a href='/users/login'>login</a>." ?></i></p>
<?php endif; ?>

<!--Members' list.-->
<?php foreach ($view_users as $user):?>
	<div class="member">
		<img src="<?= AVATAR_PATH.$user['avatar'] ?>" alt="<?= $user->first_name ?>"><h2><?= $user['first_name'] ?> <?= $user['last_name'] ?></h2>
	</div>
		
<?php endforeach; ?>
	
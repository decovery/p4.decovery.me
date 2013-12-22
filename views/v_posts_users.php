<!--Display users' info for registered users-->
<?php foreach($users as $user): ?>

	<div class="member">
		<img src="<?= AVATAR_PATH.$user['avatar'] ?>" class="avatar" alt="<?= $user->first_name ?>">
		<h2><?= $user['first_name'] ?> <?= $user['last_name'] ?></h2>
		
		<!--Follow/unfollow link-->
		<?php if(isset($connections[$user['user_id']])): ?>
			<i><a class="unfollow" href='/posts/unfollow/<?= $user['user_id'] ?>'>Unfollow</a></i>
		<?php else: ?>
			<i><a class="follow" href='/posts/follow/<?= $user['user_id'] ?>'>Follow</a></i>
		<?php endif; ?>
		
		<!--If user provided bio display it-->
		<?php if(!empty($user['bio'])): ?>
			<div class="bio">
				<p><?= $user['bio'] ?></p>
			</div>
		<?php endif; ?>
	</div>
	
<?php endforeach; ?>
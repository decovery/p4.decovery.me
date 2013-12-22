<!--User's profile-->
<h1>This is the profile of <?= $user->first_name ?> </h1>

<h2>Name: <?= $user->first_name ?> <?= $user->last_name ?></h2>
<i>Joined us: <?= Time::display($user->created) ?></i>

<!--If user provided - display bio-->
<?php if(!empty($user->bio)): ?>
	<div class="bio">
		<p><?= $user->bio ?></p>
	</div>
<?php endif; ?>

<br /><br />

<img src="<?= $user->avatar ?>" alt="<?= $user->first_name ?>" />

<br /><br />

<!--Menu for editing profile-->
<div class="edit-profile">
	<a href='/users/upload_avatar'>Upload your photo</a>
	<a href='/users/edit_profile'>Edit your profile</a>
</div>
	
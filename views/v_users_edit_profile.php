<!--Edit user's profile-->
<h1>Edit the profile of <?= $user->first_name ?> </h1>
<br>
<h2>Name: <?= $user->first_name ?> <?= $user->last_name ?></h2>
<br />
<h2>Bio: </h2>
<!--Edit or fill in user's short bio-->
<?php $form->open($name = 'form', $action = '/users/p_edit_profile/', $html = NULL, $method = 'post'); ?>

	<?=$form->textarea('bio'); ?><br />
	
	<input type='submit'>

</form>

<br /><br />
	
<img src="<?=$avatar?>" class="avatar" alt="<?= $user->first_name ?>">
	
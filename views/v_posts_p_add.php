<!--Display added post-->
<?= $post ?><br />
<?php if($image == NULL): ?>
	<?= ' ' ?>
<?php elseif ($image == 'Invalid file type.'): ?>
	<?= ' ' ?>
<?php else: ?>
	<img src="/uploads/covers/<?= $image ?>" alt="" />
<?php endif; ?>
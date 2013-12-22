<!--Display posts from followed users-->
<?php foreach ($posts as $post): ?>

<article class="post">

	<div class="left">
		<h2><?= $post['author'] ?> &ldquo;<?= $post['title'] ?>&rdquo;</h2>
		<i>By: <?= $post['first_name'] ?> <?= $post['last_name'] ?></i>
		 | <i>Added: <time datetime="<?= Time::display($post['created'], 'Y-m-d G:i') ?>">
			<?= Time::display($post['created']) ?>
		</time></i>
		<p><?= $post['content'] ?></p>
	</div>
	
	<div class="right">
		<?php if($post['image'] == NULL): ?>
			<?= ' ' ?>
		<?php elseif ($post['image'] == 'Invalid file type.'): ?>
			<?= ' ' ?>
		<?php else: ?>
			<img src="<?= '/uploads/covers/'.$post['image'] ?>" alt="" />
		<?php endif; ?>
	</div>
	
</article>

<?php endforeach; ?>


<?php if($posts == NULL && $my_posts == NULL): ?>
	<i>No posts to display.</i>
<?php endif; ?>
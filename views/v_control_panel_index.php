<!--<h1>Control Panel</h2>-->
<i>Number of reviews:</i> <span id='post_count'></span><br>
<i>Number of users:</i> <span id='user_count'></span><br>
<i>Most recent post:</i> <span id='most_recent_post'></span><br><br>
<!--If there is an image, display it.-->
<?php if ($post['image'] == NULL): ?>
<?php else: ?>
	<i>Recently added:</i><br /><br /><img src id='image'><br>
<?php endif; ?>
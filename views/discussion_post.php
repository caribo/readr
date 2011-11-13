<h2><?php echo $module->getCode()." - ".$module->getTitle(); ?></h2>

<div id="moduleLinks" style="margin-bottom: 15px;">
	<a href="index.php?action=module&id=<?php echo $module->getID(); ?>"><img src="<?php echo BASE_URL ?>res/img/report.png" alt="Overview" /> Overview</a>
	<a href="index.php?action=discussion_thread&id=<?php echo $module->getID(); ?>"><img src="<?php echo BASE_URL ?>res/img/comments.png" alt="Discuss this module" /> Discussions</a>
	<!--<a href="index.php?action=feedback&id=<?php echo $module->getID(); ?>"><img src="<?php echo BASE_URL ?>res/img/heart_add.png" alt="Leave feedback about this module" /> Leave Feedback</a>
	<a href="index.php?action=useful_links&id=<?php echo $module->getID(); ?>"><img src="<?php echo BASE_URL ?>res/img/lightbulb_add.png" alt="Add Useful Link or Resource relating to this module" /> Add Useful Links</a>-->
	<?php if($user->getRole() > 0) { ?>
	<a href="index.php?action=massmail&id=<?php echo $module->getID(); ?>"><img src="<?php echo BASE_URL ?>res/img/email_go.png" alt="Send mass email to this module group" /> Mass Email</a>
	<?php } ?>
</div>

<p class="heading noMarginTop"><?php echo $thread->getSubject(); ?></p>
<!--<div class="discussion_threads"><a href="#">Back to Discussion Threads</a></div><br />-->
<?php foreach($posts as $post) { ?>
<table style="padding:10px; background-color:white; width: 640px;">
	<tr>
	<td style="padding:10px; text-align:justify;">
	<?php echo nl2br($post->getMessage()); ?> 
	</td>
	</tr>
</table>
<table style="margin-top:-5px; margin-bottom:10px;">
	<tr>
		<td style="padding:10px;">Posted on <?php echo date("jS M  Y H.s", $post->getPosted()); ?> by <?php echo $post->getAuthor()->getName(); ?></td>
	</tr>
</table>
<?php } ?>

<form action="endpoints/submitdiscussionpost.php" method="post">
Message:<br /><textarea name="message" style="width:635px; height:100px; margin-top:5px;"></textarea><br>
<input type="hidden" name="thread_id" value="<?php echo $thread->getID(); ?>">
<input type="submit" value="Post" name="submit" style="margin-top: 10px;">
</tr>
</table>
</form>
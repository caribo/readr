<div class="wrapper">
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

<p class="heading noMarginTop">Discussions</p>

<div class="thread">
<?php if($threads) { ?>
<?php $threadNum = 0; ?>
<?php foreach($threads as $thread) { $threadNum++; ?>
<ul>
<li><a href="index.php?action=discussion_post&id=<?php echo $thread->getID(); ?>"><?php echo $threadNum; ?>. <?php echo $thread->getSubject(); ?> (<?php echo $thread->getNumPosts(); ?> posts)</a></li>
</ul>
<?php } ?>
<?php } else { ?>
There are no threads yet!
<?php } ?>
</div>

<form action="endpoints/submitdiscussionthread.php" method="post">
<h3>New Thread</h3> 
<input type="hidden" name="module_id" value="<?php echo $module->getID(); ?>">
Subject:<br><input type="text" name="subject" style="width: 625px; margin-top: 5px; margin-bottom: 5px;" /><br>
Message:<br><textarea name="message" style="width:625px; height:100px; margin-top:5px;"></textarea>
<br><input type="submit" value="Create Thread" style="margin-top: 10px;" name="submit">
</form>
</div>
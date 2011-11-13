<div class="snapShots">
	<p class="heading noMarginTop">Assignments Snapshot</p>
	<p><span class="snapShotItem">Assignments Released</span> <?php echo $assignments_count; ?><p>
	<p><span class="snapShotItem">Assignments Submitted</span> <?php echo $assignments_submitted; ?></p>
	<p><span class="snapShotItem">Assignments Graded</span> <?php echo $assignments_graded; ?></p>
	<?php if($assignment_nearest) { ?>
	<p><span class="snapShotItem">Next Assignment Due</span> <?php echo date("jS M  Y H.s", $assignment_nearest); ?></p>
	<?php } else { ?>
	<p><span class="snapShotItem">No assignments due</p>
	<?php } ?>
</div>

<!--<div class="snapShots">
	<p class="heading noMarginTop">Latest Links Posted</p>
	<p><a href="#"><strong>From Paul K:
	 </strong>
		consectetur adipisicing elit, sed do eiusmod tempor incididu...</a></p>
	<p><a href="#"><strong>From Jozef H: </strong>
	consectetur adipisicing elit, sed do eiusmod tempor incididu...</a></p>
	<p><a href="#"><strong>From Steve S: </strong>
	consectetur adipisicing elit, sed do eiusmod tempor incididu...</a></p>
</div>-->

<div class="snapShots">
	<p class="heading noMarginTop">Latest Discussions</p>
	<?php if($discussions)  {?>
	<?php foreach($discussions as $discussion) { ?>
	<?php
		$author = new User($discussion["author"]);
	?>
	<p><a href="index.php?action=discussion_post&id=<?php echo $discussion["thread_id"]; ?>"><strong><?php echo $discussion["subject"]; ?></strong><br />
	<?php echo $author->getName(); ?> said <?php echo truncateString($discussion["message"], 50); ?></a></p>
	<?php } ?>
	<?php } ?>
</div>
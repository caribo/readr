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

<p class="heading noMarginTop">Grade Assignment: <?php echo $assignment->getTitle(); ?></p>

<?php if($submissions) { ?>
<table id="gradesTable">
		<tr>
			<th>
				Name
			</th>
			<th>
				Submitted
			</th>
			<th>
				Download
			</th>
			<th>
				Grade
			</th>
			<th>
				Feedback
			</th>
			<th>
				Submit
			</th>
		</tr>
		
		<?php foreach($submissions as $submission) { ?>
		<?php
			$user = new User($submission["user_id"]);
			if($submission["grade"] < 0) {
				$grade = "";
			} else {
				$grade = $submission["grade"];
			}
		?>
		<form method="post" action="endpoints/submitgrade.php">
		<input type="hidden" name="submission_id" value="<?php echo $submission["id"] ?>">
		<input type="hidden" name="assignment_id" value="<?php echo $assignment->getID(); ?>">
		<tr>
			<td>
				<?php echo $user->getName(); ?>
			</td>
			<td>
				<?php echo date("jS M  Y H.s", $submission["submitted"]); ?>
			</td>
			<td>
				<?php $i = 0; foreach($submission["files"] as $file) { $i++; ?>
					<a href="<?php echo BASE_URL."uploads/".$file; ?>" target="new"><?php echo $i; ?></a>
				<?php } ?>
			</td>
			<td>
				<input type="text" name="grade" value="<?php echo $grade; ?>" size="3" />%
			</td>
			<td>
				<textarea name="feedback"><?php echo htmlspecialchars($submission["feedback"]); ?></textarea>
			</td>
			<td>
				<input type="submit" value="Add Grade" onclick="return confirm('Are you sure you want to commit this grade?');" />
			</td>
		</tr>
		</form>
		<?php } ?>
		
	</form>

</table>
<?php } else { ?>
Nobody has submitted this assignment yet.
<?php  } ?>
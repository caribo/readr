<h2><?php echo $module->getCode()." - ".$module->getTitle(); ?></h2>
<p class="heading noMarginTop">Grade Assignment: <?php echo $assignment->getTitle(); ?></p>

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

<?php require('foot.php'); ?>	
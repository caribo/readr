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

<h3><?php echo $assignment->getTitle(); ?></h3>
<p class="noMarginTop"><strong>Due: <?php echo date("jS M  Y H.s", $assignment->getEndTime()); ?></strong></p>

<div id="mainLeft">
	<p class="noMarginTop">
		<?php echo $assignment->getDescription(); ?>
	</p>
	
	<?php if($assignment_files) { ?>
	<div id="assignmentFiles">
		<p class="heading noMarginTop">Assignment Resources</p>
		<ul id="assignmentFilesList">
			<?php foreach($assignment_files as $assignmentfile) { ?>
			<li>
					<a href="<?php echo BASE_URL."uploads/".$assignmentfile[0]; ?>" target="new">
					<span class="icon"><img src="res/img/icons/resource/<?php echo filenameToIconName($assignmentfile[1]); ?>.png"></span>
					<p class="tutorialTitle"><?php echo htmlspecialchars($assignmentfile[1]); ?></p>
					</a>
				<?php if ($user->getRole() > 0): ?>
					<a href="index.php?action=deleteassignmentfile&id=<?php echo $assignmentfile[2]; ?>" class="deleteResourceLink"><img src="<?php echo BASE_URL ?>res/img/delete.png" alt="Delete this resource" onclick="return confirm('Are you sure you want to delete this resource?');" /></a>
				<?php endif ?>
			</li>
			<?php } ?>
		</ul>
	</div>
	<?php } ?>
</div>
<div id="mainRight">
	<?php if ($user->getRole() > 0) { ?>
		<p class="heading noMarginTop">Click <a href="index.php?action=grades&id=<?php echo $assignment->getID(); ?>">here</a> to grade this assignment.</p>
		<p class="heading noMarginTop">Add Files To Assignment</p>
		<form name="addFileForm" action="endpoints/newassignmentfile.php" method="post" enctype="multipart/form-data">
			<input type="file" name="upload[]" id="addFileToAss" multiple>
			<input type="hidden" name="assignment_id" value="<?php echo $assignment->getID(); ?>">
			<input type="submit" name="addFile" value="Add File" id="addFile" />	
		</form>
	<?php } ?>
	<div id="submitAssignment">
	<?php if($assignment->hasSubmitted($user)) { ?>
	<?php
		$submission = $assignment->getSubmission($user);
	?>
	<div id="assignmentSubmitted">
		<p class="heading noMarginTop">You submitted this assignment on <?php echo date("jS M  Y H.s", $submission["submitted"]); ?></p>
		<?php if($assignment->getGrade($user) >= 0) { ?>
		<p class="heading noMarginTop">Your assignment has been graded, you got <?php echo $assignment->getGrade($user); ?>%. Feedback: <?php echo $submission["feedback"]; ?></p>
		<?php } ?>
		<?php if(!empty($submission["files"])) { ?>
		<ul id="submittedFilesList">
			<?php foreach($submission["files"] as $file) { ?>
			<?php $filename = explode("/",$file); $filename = $filename[sizeof($filename)-1]; ?>
			
				<li class="clearfix">
				<a href="<?php echo BASE_URL."uploads/".$file; ?>" target="new">
				<span class="icon"><img src="res/img/icons/resource/<?php echo filenameToIconName($filename); ?>.png"></span>
				<p class="tutorialTitle"><?php echo $filename; ?></p>
				</a>
			</li>
			<?php } ?>
		</ul>
		<?php } ?>
	</div>
	<?php } ?>
	<?php if(!$assignment->hasSubmitted($user) || $assignment->allowMultipleSubmissions()) { ?>
	<p class="heading noMarginTop">Submit Your Assignment</p>
	<div id="submitAssignmentForm">
		<form name="submitAssignmentForm" method="post" action="<?php echo BASE_URL; ?>endpoints/submitassignment.php" enctype="multipart/form-data">
			<input type="hidden" name="assignment_id" value="<?php echo $assignment->getID(); ?>">
			<input type="file" value="" name="upload[]" class="input_style" multiple>
			<textarea name="description"></textarea>
			<input type="submit" value="Submit Assignment" onclick="return confirm('Are you sure you want to submit this assignment?');" />
		</form>
	</div>
	</div>
	<?php } ?>
</div>
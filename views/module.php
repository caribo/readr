<h2 id="modulePageTitle"><?php echo $module->getCode()." - ".$module->getTitle(); ?></h2>

<div id="moduleLinks">
	<a href="index.php?action=module&id=<?php echo $module->getID(); ?>"><img src="<?php echo BASE_URL ?>res/img/report.png" alt="Overview" /> Overview</a>
	<a href="index.php?action=discussion_thread&id=<?php echo $module->getID(); ?>"><img src="<?php echo BASE_URL ?>res/img/comments.png" alt="Discuss this module" /> Discussions</a>
	<!--<a href="index.php?action=feedback&id=<?php echo $module->getID(); ?>"><img src="<?php echo BASE_URL ?>res/img/heart_add.png" alt="Leave feedback about this module" /> Leave Feedback</a>
	<a href="index.php?action=useful_links&id=<?php echo $module->getID(); ?>"><img src="<?php echo BASE_URL ?>res/img/lightbulb_add.png" alt="Add Useful Link or Resource relating to this module" /> Add Useful Links</a>-->
	<?php if($user->getRole() > 0) { ?>
	<a href="index.php?action=massmail&id=<?php echo $module->getID(); ?>"><img src="<?php echo BASE_URL ?>res/img/email_go.png" alt="Send mass email to this module group" /> Mass Email</a>
	<?php } ?>
</div>

<?php if($lectures) { ?>
<div class="listContainer">
	<p class="listTitle">Lectures<?php if( $user->getRole() > 0 ): ?> <a href="index.php?action=newresource&id=<?php echo $module->getID(); ?>&type=1">Add Lecture</a><?php endif; ?></p>
	<ul id="lectureList" class="clearfix">
		<?php foreach($lectures as $lecture) { ?>
		<li class="clearfix">
		<a href="index.php?action=resource&id=<?php echo $lecture->getID(); ?>" target="new">			
			<span class="icon"><img src="res/img/icons/resource/<?php echo filenameToIconName($lecture->getFile()); ?>.png"></span>
			<p class="lectureTitle"><?php echo $lecture->getTitle(); ?></p>
		</a>
		<?php if ( $user->getRole() > 0 ): ?>
			<a href="index.php?action=deleteresource&id=<?php echo $lecture->getID(); ?>" class="deleteResourceLink"><img src="<?php echo BASE_URL ?>res/img/delete.png" alt="Delete this resource" onclick="return confirm('Are you sure you want to delete this resource?');" /></a>
		<?php endif ?>
		</li>
		<?php } ?>
	</ul>
</div>
<?php } ?>

<?php if($resources) { ?>
<div class="listContainer">
	<p class="listTitle">Resources<?php if( $user->getRole() > 0 ): ?> <a href="index.php?action=newresource&id=<?php echo $module->getID(); ?>&type=2">Add Resource</a><?php endif; ?></p>
	<ul id="tutorialList" class="clearfix">
		<?php foreach($resources as $resource) { ?>
		<li class="clearfix">
			<a href="index.php?action=resource&id=<?php echo $resource->getID(); ?>" target="new">
			<span class="icon"><img src="res/img/icons/resource/<?php echo filenameToIconName($resource->getFile()); ?>.png"></span>
			<p class="tutorialTitle"><?php echo $resource->getTitle(); ?></p>
			</a>
			<?php if ( $user->getRole() > 0 ): ?>
				<a href="index.php?action=deleteresource&id=<?php echo $resource->getID(); ?>" class="deleteResourceLink"><img src="<?php echo BASE_URL ?>res/img/delete.png" alt="Delete this resource" onclick="return confirm('Are you sure you want to delete this resource?');" /></a>
			<?php endif ?>
		</li>
		<?php } ?>
	</ul>
</div>
<?php } ?>


<?php if($assignments) { ?>
<div class="listContainer">
	<p class="listTitle">Assignments<?php if( $user->getRole() > 0 ): ?> <a href="index.php?action=newassignment&id=<?php echo $module->getID(); ?>">Add Assignment</a><?php endif; ?></p>
	<ul id="tutorialList" class="clearfix">
		<?php foreach($assignments as $assignment) { ?>
		<li class="clearfix">
			<a href="index.php?action=assignment&id=<?php echo $assignment->getID(); ?>">
			<span class="icon"><img src="res/img/icons/resource/file.png"></span>
			<p class="tutorialTitle"><?php echo $assignment->getTitle(); ?></p>
			</a>
			<?php if ( $user->getRole() > 0 ): ?>
				<a href="index.php?action=deleteassignment&id=<?php echo $assignment->getID(); ?>" class="deleteResourceLink"><img src="<?php echo BASE_URL ?>res/img/delete.png" alt="Delete this resource" onclick="return confirm('Are you sure you want to delete this resource?');" /></a>
			<?php endif ?>
		</li>
		<?php } ?>
	</ul>
</div>
<?php } ?>

<div style="clear:both;"></div>
<br />
<!--<p class="listTitle">Useful Online Resources</p>
<ul id="usefulLinks">
	<li style="padding:10px; background-color:white;">
		<p><span style="float:right;margin:0 0 10px 10px"><img src="<?php echo BASE_URL ?>res/img/thumb_up.png" />
		<img src="<?php echo BASE_URL ?>res/img/thumb_down.png" /></span>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tempus aliquet quam nec fringilla. Integer hendrerit lacinia velit, in interdum elit aliquam eu. Suspendisse rutrum viverra nunc at pretium. Praesent mattis laoreet magna in mollis. In hac habitasse platea dictumst. Morbi eget purus lorem, sed consequat ligula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p> 
		<span style="padding:10px 10px 10px 0;display:inline-block;">Posted on 13/11/2011</span>
		<span style="padding:10px;">Posted by Paul Kutschmarski</span>
	</li>
</ul>__>





<div class="wrapper clearfix">
<h2><?php echo $module->getCode()." ".$module->getTitle(); ?></h2>

<div id="moduleLinks" style="margin-bottom: 15px;">
	<a href="index.php?action=module&id=<?php echo $module->getID(); ?>"><img src="<?php echo BASE_URL ?>res/img/report.png" alt="Overview" /> Overview</a>
	<a href="index.php?action=discussion_thread&id=<?php echo $module->getID(); ?>"><img src="<?php echo BASE_URL ?>res/img/comments.png" alt="Discuss this module" /> Discussions</a>
	<!--<a href="index.php?action=feedback&id=<?php echo $module->getID(); ?>"><img src="<?php echo BASE_URL ?>res/img/heart_add.png" alt="Leave feedback about this module" /> Leave Feedback</a>
	<a href="index.php?action=useful_links&id=<?php echo $module->getID(); ?>"><img src="<?php echo BASE_URL ?>res/img/lightbulb_add.png" alt="Add Useful Link or Resource relating to this module" /> Add Useful Links</a>-->
	<?php if($user->getRole() > 0) { ?>
	<a href="index.php?action=massmail&id=<?php echo $module->getID(); ?>"><img src="<?php echo BASE_URL ?>res/img/email_go.png" alt="Send mass email to this module group" /> Mass Email</a>
	<?php } ?>
</div>

<p class="heading noMarginTop">Add Assignment</p>

<table>
	<form name="gradeForm" method="post" enctype="multipart/form-data" action="endpoints/newassignment.php">
		<input type="hidden" name="module_id" value="<?php echo $module->getID(); ?>">
		<tr>
        	<td style="padding:5px 5px;">Title:</td>
            <td style=" padding:5px 0px;"> <input type="text" name="title" style="width:400px;" /></td>
        </tr>
        <tr>
        	<td style=" padding:5px 5px;">Description:</td>
            <td style=" padding:5px 0px;"><textarea type="text" name="description" style="width:400px; height:100px;" /></textarea></td>
        </tr>
        <tr>
        	<td style=" padding:5px 5px;">Start Date:</td>
            <td style=" padding:5px 0px;"><input type="text" name="start_time" style="width:400px;" id="start_time" /></td>
        </tr>
        <tr>
        	<td style=" padding:5px 5px;">Deadline:</td>
            <td style=" padding:5px 0px;"><input type="text" name="end_time" style="width:400px;" id="end_time" /></td>
        </tr>
        <tr>
        	<td style=" padding:5px 5px;">Show:</td>
            <td style=" padding:5px 0px;"><input type="checkbox" name="show" value="show" checked></td>
        </tr>
        <tr>
        	<td style=" padding:5px 5px;">Allow multiple submissions:</td>
            <td style=" padding:5px 0px;"><input type="checkbox" name="multiple_submissions" value="multiple_submissions" /></td>
        </tr>
        <tr>
        	<td style=" padding:5px 5px;"></td>
            <td style=" padding:5px 0px;"><br /><input type="submit" name="submit" value="Submit" /></td>
        </tr>
	</form>
</table>

</div>


<script type="text/javascript">
$('#start_time').datetimepicker();
$('#end_time').datetimepicker();
</script>

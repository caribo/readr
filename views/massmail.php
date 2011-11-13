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

<p class="heading noMarginTop">Send e-mail</p>

<table>
	<form name="resourceForm" action="endpoints/massmail.php" method="post">
		<input type="hidden" name="module_id" value="<?php echo $module->getID(); ?>" id="module_id" />
		<tr>
        	<td style="padding:5px 5px;">Subject:</td>
            <td style=" padding:5px 0px;"> <input type="text" name="subject" style="width:400px;" /></td>
        </tr>
        <tr>
        	<td style=" padding:5px 5px;">Message:</td>
            <td style=" padding:5px 0px;"><textarea type="text" name="message" style="width:400px; height:100px;" /></textarea></td>
       </tr>
        <tr>
        	<td style=" padding:5px 5px;"></td>
            <td style=" padding:5px 0px;"><br /><input type="submit" name="submit" value="Submit" /></td>
        </tr>
	</form>
</table>
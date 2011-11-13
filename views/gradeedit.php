<?php require('config.php'); ?>
<?php require('head.php'); ?>

<h2>CO2401 Advanced Programming With C++</h2>
<p class="heading noMarginTop">Grade This Assignment</p>

<table>
	<form name="gradeForm">
		<tr>
			<th>
				Student Name
			</th>
			<th>
				Student Number
			</th>
			<th>
				Submission Time
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
		
		<tr>
			<td>
				Student Name
			</td>
			<td>
				Student Number
			</td>
			<td>
				Submission Time
			</td>
			<td>
				<input type="text" name="grade" width="50px" />
			</td>
			<td>
				<textarea name="gradeFeedback"></textarea>
			</td>
			<td>
				<input type="submit" value="Add Grade" onclick="return confirm('Are you sure you want to commit this grade?');" />
			</td>
		</tr>
		
	</form>

</table>

<?php require('foot.php'); ?>	
<?php
	require_once("../objects/main.php");
	require_login();
	
	$user_id = $_SESSION["userid"];
	$user = new User($user_id);
	
	if(!isset($_POST["assignment_id"])) {
		header("Location: ".BASE_URL."index.php");
	}
	
	if(empty($_FILES)) {
		die("No files uploaded");
	}
	
	$assignment_id = doEscape($_POST["assignment_id"]);
	$assignment = new Assignment($assignment_id);
	$description = doEscape($_POST["description"]);
	$module_id = $assignment->getModuleID();
	
	doQuery("DELETE FROM submission, submission_file USING submission, submission_file WHERE submission.id = submission_file.submission_id AND submission.user_id = ".doEscape($user_id)." AND submission.assignment_id = ".doEscape($assignment_id));
	
	$result = doQuery("INSERT INTO submission (user_id, module_id, assignment_id, description, submitted) VALUES(".$user_id.", ".$module_id.", ".$assignment_id.", '".$description."', ".time().")", true);
	$submission_id = $result[1];
	
	$files=array();
	$fdata=$_FILES['upload'];
	if(is_array($fdata['name'])){
		for($i=0;$i<count($fdata['name']);++$i){
			$files[]=array(
				'name'     => $fdata['name'][$i],
				'tmp_name' => $fdata['tmp_name'][$i],
			);
		}
	} else {
		$files[] = $fdata;
	}
		
	foreach ($files as $file) {
		$extension = substr($file['name'], strrpos($file['name'], '.')+1);
		$filename = $user->getUsername()."-".uniqid().".".$extension;
		move_uploaded_file($file["tmp_name"], ROOT_DIR."uploads/".$filename);
		doQuery("INSERT INTO submission_file (submission_id, file) VALUES(".$submission_id.", '".doEscape($filename)."')");
	}
	
	header("Location: ".BASE_URL."index.php?action=assignment&id=".$assignment_id);
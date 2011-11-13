<?php

	require_once("../objects/main.php");
	require_login();
	
	$user_id = $_SESSION["userid"];
	$user = new User($user_id);
	
	if(!isset($_POST["module_id"])) {
		header("Location: ".BASE_URL."index.php");
	}
	$module_id = $_POST["module_id"];
	
	if(!isset($_POST["resource_type"])) {
		header("Location: ".BASE_URL."index.php?action=module&id=".doEscape($module_id));
	}
	$resource_type = $_POST["resource_type"];
	
	if(!isset($_POST["title"]) || empty($_POST["title"]) || !isset($_POST["description"]) || empty($_POST["description"])) {
		header("Location: ".BASE_URL."index.php?action=newresource&id=".$module_id."&type=".$resource_type);
		exit(0);
	}
	
	if(empty($_FILES["upload"]["tmp_name"])) {
		header("Location: ".BASE_URL."index.php?action=newresource&id=".$module_id."&type=".$resource_type);
		exit(0);
	}
	
	$title = doEscape($_POST["title"]);
	$description = doEscape($_POST["description"]);
	
	$extension = substr($_FILES["upload"]['name'], strrpos($_FILES["upload"]['name'], '.')+1);
	$filename = $user->getUsername()."-".uniqid().".".$extension;
	move_uploaded_file($_FILES["upload"]["tmp_name"], ROOT_DIR."uploads/".$filename);
	
	$result = doQuery("INSERT INTO resources (module_id, title, description, uploaded, type, file) VALUES(".$module_id.", '".$title."', '".$description."', ".time().", ".doEscape($resource_type).", '".doEscape($filename)."')", true);
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
	
	header("Location: ".BASE_URL."index.php?action=module&id=".$module_id);
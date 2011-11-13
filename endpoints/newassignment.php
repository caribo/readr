<?php

	require_once("../objects/main.php");
	require_login();
	
	$user_id = $_SESSION["userid"];
	$user = new User($user_id);
	
	if(!isset($_POST["module_id"])) {
		header("Location: ".BASE_URL."index.php");
	}
	$module_id = $_POST["module_id"];
	
	if(!isset($_POST["title"]) || empty($_POST["title"]) || !isset($_POST["description"]) || empty($_POST["start_time"]) || !isset($_POST["start_time"]) || empty($_POST["description"]) || !isset($_POST["end_time"]) || empty($_POST["end_time"])) {
		header("Location: ".BASE_URL."index.php?action=newassignment&id=".$module_id);
		exit(0);
	}
	
	$title = doEscape($_POST["title"]);
	$description = doEscape($_POST["description"]);
	$start_time = strtotime($_POST["start_time"]);
	$end_time = strtotime($_POST["end_time"]);
	
	if($_POST["show"] == "show") {
		$show = 1;
	} else {
		$show = 0;
	}

	if($_POST["multiple_submissions"] == "multiple_submissions") {
		$multiple_submissions = 1;
	} else {
		$multiple_submissions = 0;
	}
	
	$result = doQuery("INSERT INTO assignments (module_id, title, description, open, multiplesubmissions, start_time, end_time) VALUES(".$module_id.", '".$title."', '".$description."', ".$show.", ".$multiple_submissions.", ".$start_time.", ".$end_time.")", true);
	
	header("Location: ".BASE_URL."index.php?action=module&id=".$module_id);
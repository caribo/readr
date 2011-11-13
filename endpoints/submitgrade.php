<?php
	require_once("../objects/main.php");
	require_login();
	
	$user_id = $_SESSION["userid"];
	$user = new User($user_id);
	
	if(!isset($_POST["submission_id"])) {
		header("Location: ".BASE_URL."index.php");
	}
	$submission_id = $_POST["submission_id"];

	if(!isset($_POST["assignment_id"])) {
		header("Location: ".BASE_URL."index.php");
	}
	$assignment_id = $_POST["assignment_id"];
	
	if(!isset($_POST["grade"]) || empty($_POST["grade"])) {
		header("Location: ".BASE_URL."index.php");
	}
	$grade = intval($_POST["grade"]);
	if(empty($grade)) {
		$grade = -1;
	}
	

	if(!isset($_POST["feedback"]) || empty($_POST["feedback"])) {
		header("Location: ".BASE_URL."index.php");
	}
	$feedback = htmlspecialchars($_POST["feedback"]);
	
	
	$result = doQuery("UPDATE submission SET grade = ".doEscape($grade).", feedback = '".doEscape($feedback)."' WHERE id = ".doEscape($submission_id));
	
	header("Location: ".BASE_URL."index.php?action=grades&id=".$assignment_id);
<?php
	require_once("../objects/main.php");
	require_login();
	
	$user_id = $_SESSION["userid"];
	$user = new User($user_id);
	
	if(!isset($_POST["module_id"]) || empty($_POST["module_id"])) {
		header("Location: ".BASE_URL."index.php");
	}
	$module_id = $_POST["module_id"];

	if(!isset($_POST["subject"]) || empty($_POST["subject"])) {
		header("Location: ".BASE_URL."index.php?action=module&id=".$module_id);
	}
	$subject = htmlspecialchars($_POST["subject"]);
	
	if(!isset($_POST["message"]) || empty($_POST["message"])) {
		header("Location: ".BASE_URL."index.php?action=module&id=".$module_id);
	}
	$message = htmlspecialchars($_POST["message"]);
	
	$result = doQuery("INSERT INTO discussion_threads (module_id, user_id, subject, posted) VALUES(".doEscape($module_id).", ".doEscape($user_id).",'".doEscape($subject)."', ".time().")", true);
	$thread_id = $result[1];
	
	$result = doQuery("INSERT INTO discussion_posts (thread_id, user_id, message, posted) VALUES(".doEscape($thread_id).", ".doEscape($user_id).", '".doEscape($message)."', ".time().")", true);
	
	header("Location: ".BASE_URL."index.php?action=discussion_post&id=".$thread_id);
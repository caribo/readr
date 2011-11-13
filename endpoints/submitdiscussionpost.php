<?php
	require_once("../objects/main.php");
	require_login();
	
	$user_id = $_SESSION["userid"];
	$user = new User($user_id);
	
	if(!isset($_POST["thread_id"])) {
		header("Location: ".BASE_URL."index.php");
	}
	$thread_id = $_POST["thread_id"];
	
	if(!isset($_POST["message"]) || empty($_POST["message"])) {
		header("Location: ".BASE_URL."index.php?action=discussion_thread&id=".$thread_id);
	}
	$message = htmlspecialchars($_POST["message"]);
	
	$result = doQuery("INSERT INTO discussion_posts (thread_id, user_id, message, posted) VALUES(".doEscape($thread_id).", ".doEscape($user_id).", '".doEscape($message)."', ".time().")");
	
	header("Location: ".BASE_URL."index.php?action=discussion_post&id=".$thread_id);
<?php

require_once("../objects/main.php");

$username = filter_input(INPUT_POST, "username", FILTER_UNSAFE_RAW);
$password = filter_input(INPUT_POST, "password", FILTER_UNSAFE_RAW);

$authentication_result = authenticate_user($username, $password);

if(!$authentication_result) {
	// Login failed
	header("Location: ".BASE_URL."login.php?error=loginfailed");
} else {
	// Login OK
	$_SESSION["userid"] = $authentication_result;
	header("Location: ".BASE_URL);
}
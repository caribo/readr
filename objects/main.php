<?php

// Set the type of authentication used (default is simple, in future we should add LDAP)
// This loads the appropriate authentication code from ./objects/auth/xyz.php
DEFINE("AUTHENTICATION_TYPE", "simple");

// Set the root directory the codebase is located at (include a trailing slash)
DEFINE("ROOT_DIR", "/var/www/devxs/");

// Set the base URL
DEFINE("BASE_URL", "http://devxs.hexxeh.net/");

/* ---------------------------
  DO NOT EDIT BELOW THIS LINE
------------------------------*/

session_start();

require_once(ROOT_DIR."/objects/util.php");
require_once(ROOT_DIR."/objects/db.php");
require_once(ROOT_DIR."/objects/user.php");
require_once(ROOT_DIR."/objects/module.php");
require_once(ROOT_DIR."/objects/assignment.php");
require_once(ROOT_DIR."/objects/resources.php");
require_once(ROOT_DIR."/objects/discussion_post.php");
require_once(ROOT_DIR."/objects/discussion_thread.php");
require_once(ROOT_DIR."/objects/auth/".AUTHENTICATION_TYPE.".php");

function require_login($level = 0) {
	if(!isset($_SESSION["userid"])) {
		header("Location: login.php");
	}
	if($level > 0) {
		$user = new User($_SESSION["userid"]);
		if($user->getRole() < $level) {
			die("No permission");
		}
	}
}
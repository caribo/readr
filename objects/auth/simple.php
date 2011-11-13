<?php

function authenticate_user($username, $password) {
	$password_sha1 = sha1($password);
	$result = doQuery("SELECT id,password FROM users WHERE username = '".doEscape($username)."'");
	if(mysql_num_rows($result) == 0) {
		// no rows, user doesn't exist
		return false;
	} else {
		// we have rows, check password
		$user_row = mysql_fetch_assoc($result);
		if($user_row["password"] == $password_sha1) {
		 	// correct password, we're logged in!
		 	// return the userid
		 	// ldap would do "express registration" where required and still return this
		 	return $user_row["id"];
		} else {
			// incorrect password
			return false;	
		}
	}
}
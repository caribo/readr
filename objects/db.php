<?php

function doQuery($query, $insertid = false) {
	 $con = mysql_connect("localhost","readr","readr1337");
	 if (!$con) {
	 	die("Could not connect: " . mysql_error());
	 }
	
	mysql_select_db("readr", $con);
	
	$result = mysql_query($query);
	if($result) {
		if($insertid) {
			return array($result, mysql_insert_id());
		} else {
			return $result;
		}
	} else {
		die("Query failed - ".$query.": " . mysql_error());
	}
}

function doEscape($string) {
	//mysql_connect("localhost","readr","readr1337");
	return mysql_escape_string($string);
}
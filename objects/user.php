<?php

class User {

	var $id = -1;
	var $username = '';
    var $first_name  = '';
    var $last_name = '';
    var $email    = '';
    var $role = -1;

    function __construct($user_id)
    {
        $this->id = $user_id;
        $user_result = doQuery("SELECT * FROM users WHERE id = ".doEscape($this->id));
        $user_row = mysql_fetch_assoc($user_result);
        $this->username = $user_row["username"];
        $this->first_name = $user_row["firstname"];
        $this->last_name = $user_row["lastname"];
        $this->email = $user_row["email"];
        $this->role = $user_row["role"];
    }

	public function getID() {
		return $this->id;
	}

	public function getUsername() {
		return $this->username;
	}

	public function getFirstName() {
		return $this->first_name;
	}

	public function getLastName() {
		return $this->last_name;
	}
	
	public function getName() {
		return $this->first_name." ".$this->last_name;
	}
	
	public function getEmail() {
		return $this->email;
	}
	
	public function getRole() {
		return $this->role;
	}
	
	public function getRoleName() {
		switch($this->role) {
			case 0:
				return "Student";
				break;
			case 1:
				return "Tutor";
				break;
			case 2:
				return "Administrator";
				break;
		}
	}
	
	public function getLatestDiscussions($count = false) {
		if(!$count) {
			$limit_clause = "";
		} else {
			$limit_clause = " LIMIT ".$count;
		}
		$discussion_rows = doQuery("SELECT DISTINCT discussion_threads.subject, discussion_posts.posted, discussion_posts.thread_id, discussion_posts.message, discussion_posts.user_id, discussion_threads.module_id FROM discussion_threads, discussion_posts, members WHERE discussion_threads.id = discussion_posts.thread_id AND discussion_threads.module_id = members.module_id AND members.user_id = ".doEscape($this->id)." ORDER BY discussion_posts.posted DESC".$limit_clause);
		$discussions = array();
		
		while($discussion_row = mysql_fetch_assoc($discussion_rows)) {
			$discussion = array();
			$discussion["thread_id"] = $discussion_row["thread_id"];
			$discussion["module_id"] = $discussion_row["module_id"];
			$discussion["author"] = $discussion_row["user_id"];
			$discussion["subject"] = $discussion_row["subject"];
			$discussion["message"] = $discussion_row["message"];
			$discussion["posted"] = $discussion_row["posted"];
			array_push($discussions, $discussion);
		}
		
		return $discussions;
	}
	
	public function getModules() {
		$module_rows = doQuery("SELECT modules.id FROM modules, members WHERE modules.id = members.module_id AND members.user_id = ".doEscape($this->id));
		$module_objects = array();
		
		while($module = mysql_fetch_row($module_rows)) {
			array_push($module_objects, new Module($module[0]));
		}
		
		return $module_objects;
	}

	public function getAssignments() {
		if($this->role < 1) {
			$student_clause = " AND assignments.open = 1 ";
		} else {
			$student_clause = "";
		}
		$assignment_rows = doQuery("SELECT assignments.* FROM assignments, members WHERE assignments.module_id = members.module_id AND members.user_id = ".doEscape($this->id).$student_clause);
		$assignment_objects = array();
		
		while($assignment = mysql_fetch_row($assignment_rows)) {
			array_push($assignment_objects, new Assignment($assignment[0]));
		}
		
		return $assignment_objects;
	}
}
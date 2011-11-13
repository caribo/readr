<?php

class Module {

	var $id = -1;
    var $code  = '';
    var $title = '';
    var $description    = '';

    function __construct($module_id)
    {
        $this->id = $module_id;
        $module_result = doQuery("SELECT * FROM modules WHERE id = ".doEscape($this->id));
        $module_row = mysql_fetch_assoc($module_result);
        $this->code = $module_row["code"];
        $this->title = $module_row["title"];
        $this->description = $module_row["description"];
    }

	public function getID() {
		return $this->id;
	}

	public function getCode() {
		return $this->code;
	}

	public function getTitle() {
		return $this->title;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function getMembers() {
		$member_rows = doQuery("SELECT user_id FROM members WHERE module_id = ".doEscape($this->id));
		$member_objects = array();
		if(mysql_num_rows($member_rows) > 0) {
			while($member = mysql_fetch_row($member_rows)) {
				$member_objects[] = new User($member[0]);
			}
			return $member_objects;
		} else {
			return false;
		}
	}
	
	public function getAssignments($user) {
		if($user->role < 1) {
			$student_clause = "AND open = 1 ";
		} else {
			$student_clause = "";
		}
		$assignment_rows = doQuery("SELECT id FROM assignments WHERE module_id = ".doEscape($this->id)." ".$student_clause." ORDER BY start_time DESC");
		$assignment_objects = array();
		if(mysql_num_rows($assignment_rows) > 0) {
			while($assignment = mysql_fetch_row($assignment_rows)) {
				$assignment_objects[] = new Assignment($assignment[0]);
			}
			return $assignment_objects;
		} else {
			return false;
		}
	}

	public function getLectures() {
		$resource_rows = doQuery("SELECT id FROM resources WHERE type = 1 AND module_id = ".doEscape($this->id)." ORDER BY uploaded DESC");
		$resource_objects = array();
		if(mysql_num_rows($resource_rows) > 0) {
			while($resource = mysql_fetch_row($resource_rows)) {
				$resource_objects[] = new Resources($resource[0]);
			}
			return $resource_objects;
		} else {
			return false;
		}
	}

	public function getResources() {
		$resource_rows = doQuery("SELECT id FROM resources WHERE type != 1 AND module_id = ".doEscape($this->id)." ORDER BY uploaded DESC");
		$resource_objects = array();
		if(mysql_num_rows($resource_rows) > 0) {
			while($resource = mysql_fetch_row($resource_rows)) {
				$resource_objects[] = new Resources($resource[0]);
			}
			return $resource_objects;
		} else {
			return false;
		}
	}
	
	public function getThreads() {
		$thread_rows = doQuery("SELECT id FROM discussion_threads WHERE module_id = ".doEscape($this->id)." ORDER BY posted DESC");
		$thread_objects = array();
		if(mysql_num_rows($thread_rows) > 0) {
			while($thread = mysql_fetch_row($thread_rows)) {
				$thread_objects[] = new Discussion_Thread($thread[0]);
			}
			return $thread_objects;
		} else {
			return false;
		}
	}
}
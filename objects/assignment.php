<?php 

class Assignment {

	var $id = -1;
    var $module_id  = 1;
    var $title = '';
    var $description    = '';
    var $open = false;
    var $start_time = -1;
    var $end_time = -1;
    var $multiplesubmissions = false;

    function __construct($assignment_id)
    {
        $this->id = $assignment_id;
        $assignment_result = doQuery("SELECT * FROM assignments WHERE id = ".doEscape($this->id));
        $assignment_row = mysql_fetch_assoc($assignment_result);
        $this->module_id = $assignment_row["module_id"];
        $this->title = $assignment_row["title"];
        $this->description = $assignment_row["description"];
        $this->open = $assignment_row["open"];
        $this->multiplesubmissions = $assignment_row["multiplesubmissions"];
        $this->start_time = $assignment_row["start_time"];
        $this->end_time = $assignment_row["end_time"];
    }

	public function delete() {
		doQuery("DELETE FROM assignments WHERE id = ".doEscape($this->id));
		doQuery("DELETE FROM submission WHERE assignment_id = ".doEscape($this->id));
	}

	public function getID() {
		return $this->id;
	}

	public function getModuleID() {
		return $this->module_id;
	}

	public function getTitle() {
		return $this->title;
	}
	
	public function getDescription() {
		return $this->description;
	}

	public function allowMultipleSubmissions() {
		return $this->multiplesubmissions;
	}

	public function getOpen() {
		return $this->open;
	}
	
	public function getStartTime() {
		return $this->start_time;
	}
	
	public function getEndTime() {
		return $this->end_time;
	}
	
	public function getFiles() {
		$files = array();
		$assignments_files_result = doQuery("SELECT * FROM assignments_file WHERE assignment_id = ".doEscape($this->id));
		while($row = mysql_fetch_assoc($assignments_files_result)) {
			array_push($files, array($row["file"], $row["original_filename"], $row["id"]));
		}
		if(sizeof($files) > 0) {
			return $files;
		} else {
			return false;
		}
	}
	
	public function hasSubmitted($user) {
		$assignment_result = doQuery("SELECT * FROM submission WHERE user_id = ".doEscape($user->getID())." AND assignment_id = ".doEscape($this->id));
		if(mysql_num_rows($assignment_result) == 0) {
			return false;
		} else {
			return true;
		}
	}

	public function getGrade($user) {
		$assignment_result = doQuery("SELECT * FROM submission WHERE user_id = ".doEscape($user->getID())." AND assignment_id = ".doEscape($this->id));
		if(mysql_num_rows($assignment_result) == 1) {
			$row = mysql_fetch_assoc($assignment_result);
			return $row["grade"];
		} else {
			return false;
		}
	}
	
	public function getSubmission($user) {
		$submission_result = doQuery("SELECT * FROM submission WHERE user_id = ".doEscape($user->getID())." AND assignment_id = ".doEscape($this->id));
		$submission_row = mysql_fetch_assoc($submission_result);
		$submission["id"] = $submission_row["id"];
		$submission["submitted"] = $submission_row["submitted"];
		$submission["description"] = $submission_row["description"];
		$submission["feedback"] = $submission_row["feedback"];
		$submission["files"] = array();
		$submission_files_result = doQuery("SELECT * FROM submission_file WHERE submission_id = ".doEscape($submission["id"]));
		while($row = mysql_fetch_assoc($submission_files_result)) {
			array_push($submission["files"], $row["file"]);
		}
		return $submission;
	}

	public function getSubmissions() {
		$submission_result = doQuery("SELECT * FROM submission WHERE assignment_id = ".doEscape($this->id));
		$submissions = array();
		$submission = array();
		
		while($submission_row = mysql_fetch_assoc($submission_result)) {
			$submission["id"] = $submission_row["id"];
			$submission["user_id"] = $submission_row["user_id"];
			$submission["submitted"] = $submission_row["submitted"];
			$submission["description"] = $submission_row["description"];
			$submission["grade"] = $submission_row["grade"];
			$submission["feedback"] = $submission_row["feedback"];
			$submission["files"] = array();
			$submission_files_result = doQuery("SELECT * FROM submission_file WHERE submission_id = ".doEscape($submission["id"]));
			while($row = mysql_fetch_assoc($submission_files_result)) {
				array_push($submission["files"], $row["file"]);
			}
			array_push($submissions, $submission);
		}
		
		return $submissions;
	}
}
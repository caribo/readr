<?php 

class Resources {

	var $id = -1;
    var $module_id  = 1;
    var $title = '';
    var $description    = '';
    var $file = '';
    var $type = -1;

    function __construct($resource_id)
    {
        $this->id = $resource_id;
        $resource_result = doQuery("SELECT * FROM resources WHERE id = ".doEscape($this->id));
        $resource_row = mysql_fetch_assoc($resource_result);
        $this->module_id = $resource_row["module_id"];
        $this->title = $resource_row["title"];
        $this->description = $resource_row["description"];
        $this->type = $resource_row["type"];
        $this->file = $resource_row["file"];
    }

	public function delete() {
		echo "DELETE FROM resources WHERE id = ".doEscape($this->id);
		doQuery("DELETE FROM resources WHERE id = ".doEscape($this->id));
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

	public function getType() {
		return $this->type;
	}

	public function getFile() {
		return $this->file;
	}
}
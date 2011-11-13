<?php

class Discussion_Post {

	var $id = -1;
	var $author = -1;
    var $subject  = '';
    var $posted = -1;

    function __construct($thread_id)
    {
        $this->id = $thread_id;
        $thread_result = doQuery("SELECT * FROM discussion_posts WHERE id = ".doEscape($this->id));
        $thread_row = mysql_fetch_assoc($thread_result);
        $this->author = new User($thread_row["user_id"]);
        $this->message = $thread_row["message"];
        $this->posted = $thread_row["posted"];
    }

	public function getID() {
		return $this->id;
	}

	public function getAuthor() {
		return $this->author;
	}

	public function getMessage() {
		return $this->message;
	}
	
	public function getPosted() {
		return $this->posted;
	}
}
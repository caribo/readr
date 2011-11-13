<?php

class Discussion_Thread {

	var $id = -1;
	var $author = -1;
    var $subject  = '';
    var $posted = -1;
	var $posts = -1;
	var $module_id = -1;

    function __construct($thread_id)
    {
        $this->id = $thread_id;
        $thread_result = doQuery("SELECT discussion_threads.*, COUNT(discussion_posts.id) FROM discussion_threads, discussion_posts WHERE discussion_threads.id = ".doEscape($this->id)." AND discussion_threads.id = discussion_posts.thread_id");
        $thread_row = mysql_fetch_assoc($thread_result);
        $this->author = new User($this->id);
        $this->subject = $thread_row["subject"];
        $this->posted = $thread_row["posted"];
        $this->module_id = $thread_row["module_id"];
        $this->numposts = $thread_row["COUNT(discussion_posts.id)"];
    }

	public function getID() {
		return $this->id;
	}

	public function getModuleID() {
		return $this->module_id;
	}

	public function getAuthor() {
		return $this->code;
	}

	public function getSubject() {
		return $this->subject;
	}

	public function getNumPosts() {
		return $this->numposts;
	}

	public function getPosted() {
		return $this->posted;
	}
		
	public function getPosts() {
		$post_rows = doQuery("SELECT id FROM discussion_posts WHERE thread_id = ".doEscape($this->id)." ORDER BY posted ASC");
		$post_objects = array();
		if(mysql_num_rows($post_rows) > 0) {
			while($post = mysql_fetch_row($post_rows)) {
				$post_objects[] = new Discussion_Post($post[0]);
			}
			return $post_objects;
		} else {
			return false;
		}
	}
}
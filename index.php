<?php
	require_once("objects/main.php");
	require_login();
	
	$user_id = $_SESSION["userid"];
	$user = new User($user_id);
	
	if(!isset($_GET["action"])) {
		$title = "Overview";
		
		// Assignment overview
		$assignments = $user->getAssignments();
		$assignments_count = 0;
		$assignments_submitted = 0;
		$assignments_graded = 0;
		$assignment_nearest = false;
		foreach($assignments as $assignment) {
			$assignments_count++;
			if($assignment->hasSubmitted($user)) {
				$assignments_submitted++;
				if($assignment->getGrade($user) >= 0) {
					$assignments_graded++;
				}
			}
			if(!$assignment->hasSubmitted($user)) {
				if(!$assignment_nearest) {
					$assignment_nearest = $assignment->getEndTime();
				} elseif($assignment->getEndTime() < $assignment_nearest) {
					$assignment_nearest = $assignment->getEndTime();
				}
			}
		}
		if($assignment_nearest < time()) {
			$assignment_nearest = false;
		}
		
		// Discussions overview
		$discussions = $user->getLatestDiscussions(3);
		
		require_once(ROOT_DIR."/views/head.php");
		require_once(ROOT_DIR."/views/overview.php");
	} else {
		switch($_GET["action"]) {
			case "module":
				if(isset($_GET["id"])) {
					$module_id = doEscape($_GET["id"]);
					$module = new Module($module_id);
					$lectures = $module->getLectures();
					$resources = $module->getResources();
					$assignments = $module->getAssignments($user);
					$title = $module->getTitle();
					require_once(ROOT_DIR."/views/head.php");
					require_once(ROOT_DIR."/views/module.php");
				} else {
					$routing_error = true;
				}
				break;
			case "assignment":
				if(isset($_GET["id"])) {
					$assignment_id = doEscape($_GET["id"]);
					$assignment = new Assignment($assignment_id);
					$assignment_files = $assignment->getFiles();
					$module = new Module($assignment->getModuleID());
					$title = $module->getTitle()." - ".$module->getTitle();
					require_once(ROOT_DIR."/views/head.php");
					require_once(ROOT_DIR."/views/assignment.php");
				} else {
					$routing_error = true;
				}
				break;
			case "module":
				if(isset($_GET["id"])) {
					$module_id = doEscape($_GET["id"]);
					$module = new Module($module_id);
					$lectures = $module->getLectures();
					$resources = $module->getResources();
					$assignments = $module->getAssignments($user);
					$title = $module->getTitle();
					require_once(ROOT_DIR."/views/head.php");
					require_once(ROOT_DIR."/views/module.php");
				} else {
					$routing_error = true;
				}
				break;
			case "grades":
				if(isset($_GET["id"])) {
					$assignment_id = doEscape($_GET["id"]);
					$assignment = new Assignment($assignment_id);
					$submissions = $assignment->getSubmissions();
					$module_id = $assignment->getModuleID();
					$module = new Module($module_id);
					$title = $module->getTitle()." - ".$module->getTitle();
					require_once(ROOT_DIR."/views/head.php");
					require_once(ROOT_DIR."/views/grades.php");
				} else {
					$routing_error = true;
				}
				break;
			case "discussion_thread":
				if(isset($_GET["id"])) {
					$module_id = doEscape($_GET["id"]);
					$module = new Module($module_id);
					$title = $module->getTitle()." - ".$module->getTitle();
					$threads = $module->getThreads();
					require_once(ROOT_DIR."/views/head.php");
					require_once(ROOT_DIR."/views/discussion_thread.php");
				} else {
					$routing_error = true;
				}
				break;
			case "discussion_post":
				if(isset($_GET["id"])) {
					$thread_id = doEscape($_GET["id"]);
					$thread = new Discussion_Thread($thread_id);
					$module_id = $thread->getModuleID();
					$module = new Module($module_id);
					$title = $module->getTitle()." - ".$module->getTitle();
					$posts = $thread->getPosts();
					require_once(ROOT_DIR."/views/head.php");
					require_once(ROOT_DIR."/views/discussion_post.php");
				} else {
					$routing_error = true;
				}
				break;
			case "resource":
				if(isset($_GET["id"])) {
					$resource_id = doEscape($_GET["id"]);
					$resource = new Resources($resource_id);
					header("Location: ".BASE_URL."uploads/".$resource->getFile());
				} else {
					$routing_error = true;
				}
				break;
			case "massmail":
				if(isset($_GET["id"])) {
					$module_id = doEscape($_GET["id"]);
					$module = new Module($module_id);
					$title = $module->getTitle();
					require_once(ROOT_DIR."/views/head.php");
					require_once(ROOT_DIR."/views/massmail.php");
				} else {
					$routing_error = true;
				}
				break;
			case "newresource":
				if(isset($_GET["id"]) && isset($_GET["type"])) {
					$module_id = doEscape($_GET["id"]);
					$module = new Module($module_id);
					$resource_type = doEscape($_GET["type"]);
					require_once(ROOT_DIR."/views/head.php");
					require_once(ROOT_DIR."/views/newresource.php");
				} else {
					$routing_error = true;
				}
				break;
			case "newassignment":
				if(isset($_GET["id"])) {
					$module_id = doEscape($_GET["id"]);
					$module = new Module($module_id);
					require_once(ROOT_DIR."/views/head.php");
					require_once(ROOT_DIR."/views/newassignment.php");
				} else {
					$routing_error = true;
				}
				break;
			case "deleteresource":
				if(isset($_GET["id"])) {
					$resource_id = doEscape($_GET["id"]);
					$resource = new Resources($resource_id);
					$module_id = $resource->getModuleID();
					$resource->delete();
					header("Location: ".BASE_URL."index.php?action=module&id=".$module_id);
				} else {
					$routing_error = true;
				}
				break;
			case "deleteassignment":
				if(isset($_GET["id"])) {
					$assignment_id = doEscape($_GET["id"]);
					$assignment = new Assignment($assignment_id);
					$module_id = $assignment->getModuleID();
					$assignment->delete();
					header("Location: ".BASE_URL."index.php?action=module&id=".$module_id);
				} else {
					$routing_error = true;
				}
				break;
			case "deleteassignmentfile":
				if(isset($_GET["id"])) {
					$assignment_file_id = doEscape($_GET["id"]);
					$result = doQuery("SELECT assignment_id FROM assignments_file WHERE id = ".doEscape($assignment_file_id));
					doQuery("DELETE FROM assignments_file WHERE id = ".doEscape($assignment_file_id));
					$row = mysql_fetch_row($result);
					header("Location: ".BASE_URL."index.php?action=assignment&id=".$row[0]);
				} else {
					$routing_error = true;
				}
				break;
			default:
				$routing_error = true;
				break;
		}
		if(isset($routing_error)) {
			$title = "Error";
			require_once(ROOT_DIR."/views/head.php");
			echo "Error!";
		}
	}
	require_once(ROOT_DIR."/views/foot.php");
	
	
	
	/*echo $user->getName()."'s modules:<br><br>";
	
	$modules = $user->getModules();
	foreach($modules as $module) {
		echo $module->getTitle()."<br>";
		$assignments = $module->getAssignments();
		if($assignments) {
			foreach($assignments as $assignment) {
				echo "&nbsp;&nbsp;&nbsp;".$assignment->getTitle()."<br>";
			}
		}
	}
	
	echo '<br><br><a href="logout.php">Logout</a>';*/

?>
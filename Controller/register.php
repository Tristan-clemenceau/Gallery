<?php
	if (session_status() == PHP_SESSION_NONE) {
    	echo "session unstarted<br />";
	}else{
		echo "session started<br />";
		echo "{$_SESSION['test']}";
	}
	if (isset($_POST['fname']) && isset($_POST['lname'])) {
			echo "set";
			echo "FNAME : {$_POST['fname']} LNAME : {$_POST['lname']}";
			//header("Location: test.php");
	} else {
			echo "unset";
			//header("Location: ../index.php");
	}
?>
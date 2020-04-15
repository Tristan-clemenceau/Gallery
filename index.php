<?php
session_start();
$_SESSION['Lang'] = "en";
require('Controller/frontend.php');

try {
	if (!isset($_GET['action'])) {
		test();
	}else{
		switch ($_GET['action']) {
			case "test":
				testView();
				break;
			
			default:
				# code...
				break;
		}
	}
	
} catch (Exception $e) {
	echo 'Erreur : '.$e->getMessage();
}

?>
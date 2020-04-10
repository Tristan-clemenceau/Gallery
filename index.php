<?php
require('Controller/frontend.php');

try {
	if (!isset($_GET['action'])) {
		HomePage();
	}else{
		switch (variable) {
			case 'value':
				# code...
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
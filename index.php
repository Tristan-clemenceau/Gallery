<?php
session_start();
$_SESSION['lang'] = "fr";
$_SESSION['page'] = "TOKEN";
require('Controller/frontend.php');

try {
	if (!isset($_GET['action'])) {
		homeView();
	}else{
		switch ($_GET['action']) {
			case "test":
				testView();
				break;
			case "lang":
				if(isset($_GET['lang'])){
						switch ($_GET['lang']) {//POSSIBILITY OF EXPENSION
							case 'fr':
								$_SESSION['lang'] = "fr";
								homeView();
								break;
							case 'en':
								$_SESSION['lang'] = "en";
								homeView();
								break;
							default:
								# code...
								break;
						}
				}
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
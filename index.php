<?php
/*IMPORT*/ 
require_once('Model/Person.php');
require_once('Model/Member.php');

session_start();
$_SESSION['lang'] = "fr";
$_SESSION['page'] = "2265a29d906471a5cbe833a48168e85b23a2a9ce76cd3eb22efa013451898d24";
require('Controller/frontend.php');

try {
	if (!isset($_GET['action'])) {
		homeView();
	}else{
		switch ($_GET['action']) {
			case "test":
				testView();
				break;
			case "logout":
				if (isset($_SESSION['member'])) {
					logout();
				}else{
					homeView();
				}
				break;
			case "userAccount":
				if (isset($_SESSION['member'])) {
					account();
				}else{
					homeView();
				}
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
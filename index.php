<?php
/*IMPORT*/ 
require_once('Model/Person.php');
require_once('Model/Member.php');

session_start();
$_SESSION['lang'] = "fr";
$_SESSION['page'] = "6325f9085fc1da9a3da508fdf34e8ed1b6e7c1bd800706fbbd91547f3c602393";
require('Controller/frontend.php');

if (isset($_SESSION['member']) && !isset($_GET['action'])) {
	header("location: View/UserView.php");
	exit();
}

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
			case "userGallery":
				if (isset($_SESSION['member'])) {
					gallery();
				}else{
					homeView();
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
<?php 
/*IMPORT*/ 
require_once('../Model/Connection.php');
require_once('../Model/MemberDAO.php');
require_once('../Model/Person.php');
require_once('../Model/Member.php');
require_once('../Model/Gallery.php');
require_once('../Model/GalleryDAO.php');
/*VERIF*/
session_start();

if(isset($_SESSION['page'])){
	$data = array("state" => "", "msg" => "");
	/*IMPORT*/ 
	require_once('../Model/pageTOKEN.php');
	require_once('../Model/Multilingual.php');
	if(($_SESSION['page'] == $pageArray['index']) || ($_SESSION['page'] == $pageArray['userAcc']) || ($_SESSION['page'] == $pageArray['userView'])|| ($_SESSION['page'] == $pageArray['userGallery']) || ($_SESSION['page'] == $pageArray['searchGallery']) || ($_SESSION['page'] == $pageArray['searchUser']) || ($_SESSION['page'] == $pageArray['homeView'])){
		/*HEADER*/
		header("Content-Type: application/json");
		if(!isset($_SESSION['member']) && !isset($_POST['language'])){
			$data['state'] = "ERROR";
			$data['msg'] = "Information manquantes";
		}else{
			switch (strtolower($_POST['language'])) {
				case 'fr':
				$_SESSION['lang'] = "fr";
				$data['state'] = "OK";
				$data['msg'] = "Langue changée FR /{$_SESSION['lang']}";
				break;
				case 'en':
				$_SESSION['lang'] = "en";
				$data['state'] = "OK";
				$data['msg'] = "Langue changée en /{$_SESSION['lang']}";
				break;

				default:
				$data['state'] = "ERROR";
				$data['msg'] = "Informations non prises en compte";
				break;
			}
		}
		/*ANSWER*/
		echo json_encode( $data );
	}else{
		header("Location: ../index.php");
		exit();
	}

}else{
	header("Location: ../index.php");
	exit();
}
?>
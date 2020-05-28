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
		if(isset($_POST['UserName']) && isset($_POST['GalleryName'])){
			$data['state'] = "ERROR";
			$data['msg'] = $multilingualArray['search'][$_SESSION['lang']]['erreur03'];
		}else{
				if (isset($_POST['UserName'])){//SEARCH USER
					$memberDAO = new MemberDAO();
					$member = new Member();
					if ($memberDAO->alreadyInDb(htmlspecialchars(strip_tags($_POST['UserName']),ENT_QUOTES))) {
						$data['state'] = "OK";
						$data['msg'] = $multilingualArray['search'][$_SESSION['lang']]['success01'];
					} else {
						$data['state'] = "ERROR";
						$data['msg'] = $multilingualArray['search'][$_SESSION['lang']]['erreur01'];
					}
				}elseif (isset($_POST['GalleryName'])) {//SEARCH GALLERY
					$galleryDAO = new GalleryDAO();
					$gallery = new Gallery();
					if ($galleryDAO->alreadyTaken(htmlspecialchars(strip_tags($_POST['GalleryName']),ENT_QUOTES))) {
						$data['state'] = "OK";
						$data['msg'] = $multilingualArray['search'][$_SESSION['lang']]['success02'];
					} else {
						$data['state'] = "ERROR";
						$data['msg'] = $multilingualArray['search'][$_SESSION['lang']]['erreur02'];
					}
					
				}else{
					$data['state'] = "ERROR";
					$data['msg'] = $multilingualArray['search'][$_SESSION['lang']]['erreur04'];
				}
			}
			/*ANSWER*/
			echo json_encode( $data );
		}
		else{
			header("Location: ../index.php");
			exit();
		}

	}else{
		header("Location: ../index.php");
		exit();
	}
?>
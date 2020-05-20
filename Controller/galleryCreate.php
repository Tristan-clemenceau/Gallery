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
		if(($_SESSION['page'] == $pageArray['userAcc']) || ($_SESSION['page'] == $pageArray['userView'])|| ($_SESSION['page'] == $pageArray['userGallery']) || ($_SESSION['page'] == $pageArray['searchGallery']) || ($_SESSION['page'] == $pageArray['searchUser'])){//VERIF
			if (isset($_POST['name'])) {
			/*HEADER*/
			header("Content-Type: application/json");
			/*OBJECT*/
			$daoGallery = new GalleryDAO();
			$gallery = new Gallery();

			if($daoGallery->alreadyTaken($_POST['name'])){
				//ERREUR statut / message (fr / anglais)
				$data['state'] = "ERROR";
				$data['msg'] = $multilingualArray['galleryCreate'][$_SESSION['lang']]['erreur01'];
			}else{
				$gallery = $daoGallery->create($_POST['name'],$_SESSION['member']->getId());
				$gallery->setOwner($_SESSION['member']);

				/*ADDING OBJECT TO SESSION*/
				$_SESSION['member']->addOwned($gallery);

				
				/*JSON OBJECT*/
				$data['state'] = "OK";
				$data['msg'] = $multilingualArray['galleryCreate'][$_SESSION['lang']]['success01'];
			}

			/*ANSWER*/
			echo json_encode( $data );
			}

		}else{
			header("Location: ../index.php");
			exit();
		}

	}else{
		header("Location: ../index.php");
		exit();
	}
?>
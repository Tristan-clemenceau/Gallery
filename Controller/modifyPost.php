<?php
/*IMPORT*/ 
require_once('../Model/Connection.php');
require_once('../Model/MemberDAO.php');
require_once('../Model/Person.php');
require_once('../Model/Member.php');
require_once('../Model/Gallery.php');
require_once('../Model/GalleryDAO.php');
require_once('../Model/PostDAO.php');
/*VERIF*/
session_start();

if(isset($_SESSION['page']) && isset($_SESSION['member'])){
	$data = array("state" => "", "msg" => "");
	/*IMPORT*/ 
	require_once('../Model/pageTOKEN.php');
	require_once('../Model/Multilingual.php');
	if(($_SESSION['page'] == $pageArray['searchGallery'])){
		/*HEADER*/
		header("Content-Type: application/json");
		if(isset($_POST['idPost']) && isset($_POST['desc'])){
            $galleryDAO = new GalleryDAO();
            if ($galleryDAO->isMemberFromGallery($_POST['idPost'],$_SESSION['member']->getId())) {//USER IS MEMBER OF GALLERY
                $postDAO = new PostDAO();
                $postDAO->updateDescription(htmlspecialchars(strip_tags($_POST['desc']),ENT_QUOTES),$_POST['idPost']);
                $data['state'] = "OK";
               $data['msg'] = $multilingualArray['modifyPost'][$_SESSION['lang']]['success01'];
            } else {
               $data['state'] = "ERROR";
               $data['msg'] =  $multilingualArray['modifyPost'][$_SESSION['lang']]['erreur01'];
            }
		}else{
			$data['state'] = "ERROR";
			$data['msg'] = $multilingualArray['modifyPost'][$_SESSION['lang']]['erreur02'];
		}
		/*ANSWER*/
		echo json_encode( $data );
	}

}else{
	header("Location: ../index.php");
	exit();
}
?>
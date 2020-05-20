<?php
/*IMPORT*/ 
	require_once('../Model/Connection.php');
	require_once('../Model/MemberDAO.php');
	require_once('../Model/Person.php');
	require_once('../Model/Member.php');
	require_once('../Model/Gallery.php');
	require_once('../Model/GalleryDAO.php');
	require_once('../Model/Post.php');
	require_once('../Model/PostDAO.php');
	require_once('../Model/Image.php');
	require_once('../Model/ImageDAO.php');
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
			if(isset($_FILES['file']) && isset($_POST['desc']) && isset($_POST['galleryId'])){
				$allowedExtension = array('jpg','jpeg','png');
				if($_FILES['file']['error'] === 0 && $_FILES['file']['size'] <= 2097152){//SIZE AND NO ERROR
					$arrFile = explode('.', $_FILES['file']['name']);
					$fileExt = strtolower(end($arrFile));
					if(in_array($fileExt, $allowedExtension)){
						$fileNameGenerated = uniqid('',true).".".$fileExt;
						$destination = "../Public/Images/Uploads/".$fileNameGenerated;
						move_uploaded_file($_FILES['file']['tmp_name'], $destination);
						/*SET IMAGE*/
						$imageDAO = new ImageDAO();
						$postDAO = new PostDAO();
						$image = new Image();

						$image = $imageDAO->create($fileNameGenerated);
						$postDAO->create($_POST['desc'],$_SESSION['member']->getId(),$_POST['galleryId'],$image->getId());

						/*SET POST*/
						$data['state'] = "OK";
						$data['msg'] = $multilingualArray['upload'][$_SESSION['lang']]['success01'];
					}else{
						$data['state'] = "ERROR";
						$data['msg'] = $multilingualArray['upload'][$_SESSION['lang']]['erreur01'];
					}
				}else{
					$data['state'] = "ERROR";
					$data['msg'] = $multilingualArray['upload'][$_SESSION['lang']]['erreur02'];
				}
			}else{
				$data['state'] = "ERROR";
				$data['msg'] = $multilingualArray['upload'][$_SESSION['lang']]['erreur03'];
			}
			/*ANSWER*/
			echo json_encode( $data );
			}

		}else{
			header("Location: ../index.php");
			exit();
		}
?>
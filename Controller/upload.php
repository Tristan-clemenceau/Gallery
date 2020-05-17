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

	if(isset($_SESSION['page'])){
		$data = array("state" => "", "msg" => "");
		/*IMPORT*/ 
		require_once('../Model/pageTOKEN.php');
		require_once('../Model/Multilingual.php');
		if(($_SESSION['page'] == $pageArray['searchGallery'])){
			/*HEADER*/
			header("Content-Type: application/json");
			if(isset($_FILES['file']) && isset($_POST['desc'])){//BOTH FILE ARE RECIEVE
				$allowedExtension = array('jpg','jpeg','png');
				if($_FILES['file']['error'] === 0 && $_FILES['file']['size'] <= 31457280){//SIZE AND NO ERROR
					$arrFile = explode('.', $_FILES['file']['name']);
					$fileExt = strtolower(end($arrFile));
					if(in_array($fileExt, $allowedExtension)){
						$data['state'] = "OK";
						$data['msg'] = "Fichier ok";
					}else{
						$data['state'] = "ERROR";
						$data['msg'] = "Fichier non accepté seuls les fichiers .jpg , .jpeg , .png sont autorisés";
					}
				}else{
					$data['state'] = "ERROR";
					$data['msg'] = "Pictures is bigger than  30 mb or it was not uploaded correctly please retry ";
				}
			}else{
				$data['state'] = "ERROR";
				$data['msg'] = "Pas de receptions des deux fichiers";
			}
			/*ANSWER*/
			echo json_encode( $data );
			}

		}else{
			header("Location: ../index.php");
			exit();
		}
?>
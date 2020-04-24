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
		if(($_SESSION['page'] == $pageArray['userAcc']) || ($_SESSION['page'] == $pageArray['userView']) || ($_SESSION['page'] == $pageArray['index'])){
			/*HEADER*/
			header("Content-Type: application/json");
			if(isset($_POST['UserName']) && isset($_POST['GalleryName'])){
				$data['state'] = "ERROR";
				$data['msg'] = "Les deux champs ne peuvent pas être combiné pour la recherche";
			}else{
				if (isset($_POST['UserName'])){//SEARCH USER
					$memberDAO = new MemberDAO();
					$member = new Member();
					if ($memberDAO->alreadyInDb($_POST['UserName'])) {
						$data['state'] = "OK";
						$data['msg'] = "Utilisateur trouvé";
					} else {
						$data['state'] = "ERROR";
						$data['msg'] = "L'utilisateur n'existe pas";
					}
				}elseif (isset($_POST['GalleryName'])) {//SEARCH GALLERY
					$galleryDAO = new GalleryDAO();
					$gallery = new Gallery();
					if ($galleryDAO->alreadyTaken($_POST['GalleryName'])) {
						$data['state'] = "OK";
						$data['msg'] = "Gallerie trouvée";
					} else {
						$data['state'] = "ERROR";
						$data['msg'] = "La gallerie n'existe pas";
					}
					
				}else{
					$data['state'] = "ERROR";
					$data['msg'] = "Aux moins un des deux champs doit être remplis";
				}
			}
			/*ANSWER*/
			echo json_encode( $data );
			}

		}else{
			header("Location: ../index.php");
			exit();
		}
?>
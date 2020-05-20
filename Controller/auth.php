<?php 
	/*VERIF*/
	session_start();
	if(isset($_SESSION['page'])){
		$data = array("state" => "", "msg" => "");
		/*IMPORT*/ 
		require_once('../Model/pageTOKEN.php');
		require_once('../Model/Multilingual.php');
		if(($_SESSION['page'] == $pageArray['index']) || ($_SESSION['page'] == $pageArray['homeView']) || ($_SESSION['page'] == $pageArray['searchGallery'])|| ($_SESSION['page'] == $pageArray['searchUser'])){//VERIF
			if (isset($_POST['login']) && isset($_POST['password'])) {
			/*IMPORT*/ 
			require_once('../Model/Connection.php');
			require_once('../Model/MemberDAO.php');
			require_once('../Model/Person.php');
			require_once('../Model/Member.php');
			/*HEADER*/
			header("Content-Type: application/json");
			/*OBJECT*/
			$daoMember = new MemberDAO();
			$member = new Member();

			if($daoMember->alreadyInDb(htmlspecialchars(strip_tags($_POST['login']),ENT_QUOTES))){
				//verify login & pass
				$member = $daoMember->searchByLogin(strip_tags($_POST['login']));
				if($daoMember->verifyPass($member->getId(),$member->getLogin(),$member->setPass(htmlspecialchars(strip_tags($_POST['password']),ENT_QUOTES),$pageArray[$member->getPair()]))){
					/*ADDING OBJECT TO SESSION*/
					$_SESSION['member'] = $member;
					$data['state'] = "OK";
					$data['msg'] = $multilingualArray['auth'][$_SESSION['lang']]['success01'];
				}else{
					//eerreur
					$data['state'] = "ERROR";
					$data['msg'] = $multilingualArray['auth'][$_SESSION['lang']]['erreur01'];
				}
			}else{
				$data['state'] = "ERROR";
				$data['msg'] = $multilingualArray['auth'][$_SESSION['lang']]['erreur01'];
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
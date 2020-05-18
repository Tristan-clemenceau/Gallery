<?php 
	/*VERIF*/
	session_start();
	if(isset($_SESSION['page'])){
		$data = array("state" => "", "msg" => "");
		/*IMPORT*/ 
		require_once('../Model/pageTOKEN.php');
		require_once('../Model/Multilingual.php');
		if(($_SESSION['page'] == $pageArray['index']) || ($_SESSION['page'] == $pageArray['homeView'])){//VERIF
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

			if($daoMember->alreadyInDb($_POST['login'])){
				//verify login & pass
				$member = $daoMember->searchByLogin($_POST['login']);
				if($daoMember->verifyPass($member->getId(),$member->getLogin(),$member->setPass($_POST['password'],$pageArray[$member->getPair()]))){
					/*ADDING OBJECT TO SESSION*/
					$_SESSION['member'] = $member;
					$data['state'] = "OK";
					$data['msg'] = "Successfully login";
				}else{
					//eerreur
					$data['state'] = "ERROR";
					$data['msg'] = "Incorrect pass / username";
				}
			}else{
				//ERREUR statut / message (fr / anglais)
				$data['state'] = "ERROR";
				$data['msg'] = "Incorrect pass / username";
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
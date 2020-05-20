<?php
	/*VERIF*/
	session_start();
	if(isset($_SESSION['page'])){
		$data = array("state" => "", "msg" => "");
		/*IMPORT*/ 
		require_once('../Model/pageTOKEN.php');
		require_once('../Model/Multilingual.php');
		if(($_SESSION['page'] == $pageArray['index']) || ($_SESSION['page'] == $pageArray['homeView'])){//VERIF
			if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['dateRegister'])) {
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

			if($daoMember->alreadyInDb(htmlspecialchars(strip_tags($_POST['login']), ENT_QUOTES))){
				//ERREUR statut / message (fr / anglais)
				$data['state'] = "ERROR";
				$data['msg'] = $multilingualArray['register'][$_SESSION['lang']]['erreur01'];
			}else{
				$member = $daoMember->create(strip_tags($_POST['login']),$_POST['dateRegister'],'');
				$daoMember->updatePassword($member->getId(),$member->setPass(htmlspecialchars(strip_tags($_POST['password']),ENT_QUOTES),$pageArray[$member->getPair()]));

				/*ADDING OBJECT TO SESSION*/
				$_SESSION['member'] = $member;
				$data['state'] = "OK";
				$data['msg'] = $multilingualArray['register'][$_SESSION['lang']]['success01'];
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
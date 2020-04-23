<?php
	/*VERIF*/
	session_start();
	if(isset($_SESSION['page'])){
		/*IMPORT*/ 
		require_once('../Model/pageTOKEN.php');
		require_once('../Model/Multilingual.php');
		if(($_SESSION['page'] == $pageArray['userAcc']) || ($_SESSION['page'] == $pageArray['userView'])){//VERIF
			if (isset($_POST['name'])) {
			/*IMPORT*/ 
			require_once('../Model/connection.php');
			require_once('../Model/MemberDAO.php');
			require_once('../Model/Person.php');
			require_once('../Model/Member.php');
			/*HEADER*/
			header("Content-Type: application/json");
			/*OBJECT*/
			$daoMember = new MemberDAO();
			$member = new Member();
			$data = array();

			if($daoMember->alreadyInDb($_POST['login'])){
				//ERREUR statut / message (fr / anglais)
				$data['state'] = "ERROR";
				$data['msg'] = "Username already taken";
			}else{
				$member = $daoMember->create($_POST['login'],$_POST['dateRegister'],'');
				$daoMember->updatePassword($member->getId(),$member->setPass($_POST['password'],$pageArray[$member->getPair()]));

				/*ADDING OBJECT TO SESSION*/
				$_SESSION['member'] = $member;
				$data['state'] = "OK";
				$data['msg'] = "Successfully registered";
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
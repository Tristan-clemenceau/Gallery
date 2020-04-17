<?php 
	/*VERIF*/
	session_start();
	if(isset($_SESSION['page'])){
		/*IMPORT*/ 
		require_once('../Model/pageTOKEN.php');
		require_once('../Model/Multilingual.php');
		if($_SESSION['page'] == $pageArray['index']){//VERIF
			if (isset($_POST['login']) && isset($_POST['password'])) {
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
			$data = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

			if($daoMember->alreadyInDb($_POST['login'])){
				//verify login & pass
				$member = $daoMember->searchByLogin($_POST['login']);
				if($daoMember->verifyPass($member->getId(),$member->getLogin(),$member->setPass($_POST['password'],$pageArray[$member->getPair()]))){
					/*ADDING OBJECT TO SESSION*/
					$_SESSION['member'] = $member;
					$data['msg'] = "OK";
				}else{
					//eerreur
					$data['erreur'] = "Incorrect pass / username";
				}
			}else{
				//ERREUR statut / message (fr / anglais)
				$data['erreur'] = "Not in the base";
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
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

			$member = $daoMember->create($_POST['login'],$_POST['dateRegister'],'');
			$daoMember->updatePassword($member->getId(),$member->setPass($_POST['password'],$pageArray[$member->getPair()]));

			/*ADDING OBJECT TO SESSION*/
			$_SESSION['member'] = $member;

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











	/*CODE*/
	

	/*require_once('../Model/connection.php');
	require_once('../Model/MemberDAO.php');
	require_once('../Model/Person.php');
	require_once('../Model/Member.php');

	$test = new Member();
	$test02 = new Member();
	$test->setRegistationDate($_POST['dateRegister']);

	$daoMember = new MemberDAO();
	$d = new DateTime($_POST['dateRegister']);
	//echo date_format($d,"Y/m/d H:i:s");

	$test02 = $daoMember->create('test',$_POST['dateRegister'],'test');

	$data = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

	//$data['yo'] = date_format($test->getRegistationDate(),"Y/m/d H:i:s");
	echo json_encode( $data );*/

?>
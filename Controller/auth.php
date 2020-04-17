<?php 
	session_start();
	if(isset($_SESSION['page'])){
		/*IMPORT*/ 
		require_once('../Model/pageTOKEN.php');
		require_once('../Model/Multilingual.php');
		require_once('../Model/Member.php');

		if($_SESSION['page'] == $pageArray['index']){

			if (isset($_POST['type'])){
				switch ($_POST['type']) {
					case 'connexion':
						break;
					case 'register':
						# code...
						break;
					default:
						# code...
						break;
				}
				$data = array( 'name' => 'God', 'age' => -1 );
				$data["test"] = $_POST['type'];
				connexion($data);
			}else{
				header("Location: ../index.php");
				exit();
			}
		}
	}else{
		header("Location: ../index.php");
		exit();
	}

	function connexion($data){
		header('Content-type:application/json;charset=utf-8');
		echo json_encode( $data );
	}
?>
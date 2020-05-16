<?php

		$data = array("state" => "", "msg" => "");
			/*HEADER*/
			header("Content-Type: application/json");
			/*OBJECT*/
			$data['state'] = "OK";
			

			//$file = $_FILES['file'];

			
			if(isset($_POST['desc'])){
				$data['msg'] = "DESC Bien reçu";
				$data['msg'] = $_FILES['file']['name'];
			}else{	
				$data['msg'] = "DESC pas Bien reçu";
			}


			/*ANSWER*/
			echo json_encode( $data );

?>
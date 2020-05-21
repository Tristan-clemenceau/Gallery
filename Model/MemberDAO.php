<?php
/**
 * 
 */
class MemberDAO extends DbObject
{
	
	function __construct()
	{
		parent :: __construct();
	}

	/*CREATE*/
	public function create($login,$registrationDate,$hashUser){
		parent :: connection();
		$d = new DateTime($registrationDate);

		$sql = "INSERT INTO USER (login_User,registration_User,admin_User,hash_User) VALUES ('".$login."','".date_format($d,"Y/m/d H:i:s")."','0','{$hashUser}')";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		$id = mysqli_insert_id(parent :: getCo());

		$member = new Member($id,$login,date_create($registrationDate));

		parent :: deconnection();
		return $member;
	}

	/*READ*/
	public function searchById($id){
		parent :: connection();

		$sql = "SELECT id_User,login_User,registration_User FROM USER WHERE id_User = {$id}";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);
		$row = mysqli_fetch_row($sqlExecute);

		$member = new Member($row[0],$row[1],date_create($row[2]));

		parent :: deconnection();
		return $member;
	}

	public function searchByLogin($login){
		parent :: connection();

		$sql = "SELECT id_User,login_User,registration_User FROM USER WHERE login_User = '{$login}'";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);
		$row = mysqli_fetch_row($sqlExecute);

		$member = new Member($row[0],$row[1],date_create($row[2]));

		parent :: deconnection();
		return $member;
	}

	public function alreadyInDb($login){
		parent :: connection();

		$ok = false;

		$sql = "SELECT * FROM USER WHERE login_User = '{$login}'";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		$row = mysqli_num_rows($sqlExecute);

		if($row != 0){
			$ok = true;
		}

		parent :: deconnection();

		return $ok;
	}

	public function verifyPass($id,$login,$pass){
		parent :: connection();

		$ok = false;

		$sql = "SELECT * FROM USER WHERE id_User = {$id} AND login_User = '{$login}' AND hash_User = '{$pass}'";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		$row = mysqli_num_rows($sqlExecute);

		if($row == 1){
			$ok = true;
		}

		parent :: deconnection();

		return $ok;
	}

	/*UPDATE*/
	public function updatePassword($id,$password){
		parent :: connection();

		$sql = "UPDATE USER SET hash_User = '{$password}' WHERE id_User = {$id}";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	/*DELETE*/

	/*OTHER*/
	public function getNbPost($idUser){
		parent :: connection();

		$sql = "SELECT count(*) as NbPost FROM POST p WHERE p.publisher_Post = {$idUser}";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);
		$row = mysqli_fetch_row($sqlExecute);
		$nbPost = $row[0];

		parent :: deconnection();
		return $nbPost;
	}

	public function getNbPostGallery($idUser,$idGallery){
		parent :: connection();

		$sql = "SELECT count(*) as NbPost FROM POST p WHERE p.publisher_Post = {$idUser} AND p.id_Gallery = {$idGallery}";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);
		$row = mysqli_fetch_row($sqlExecute);
		$nbPost = $row[0];

		parent :: deconnection();
		return $nbPost;
	} 

	public function getNbMaxMemberOfOwnedGallery($idUser){
		parent :: connection();

		$sql = "SELECT count(*) as MaxUser FROM member m WHERE m.id_Gallery IN( SELECT g.id_Gallery FROM GALLERY g,USER u WHERE g.owner_Gallery = u.id_User AND u.id_User = {$idUser}) GROUP By m.id_Gallery limit 1";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);
		$row = mysqli_fetch_row($sqlExecute);

		if (!isset($row[0])) {
			$nbMember = 0;
		}else{
			$nbMember = $row[0];
		}
		

		parent :: deconnection();
		return $nbMember;
	}

	public function getAllGallery(){
		parent :: connection();

		$sql = "";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	public function getAllOwnedGallery(){
		parent :: connection();

		$sql = "";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}
}

?>
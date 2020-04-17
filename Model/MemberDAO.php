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

	/*UPDATE*/
	public function updatePassword($id,$password){
		parent :: connection();

		$sql = "UPDATE USER SET hash_User = '{$password}' WHERE id_User = {$id}";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	/*DELETE*/

	/*OTHER*/
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
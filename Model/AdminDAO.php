<?php
/**
 * 
 */
class AdminDAO extends DbObject
{
	
	function __construct()
	{
		parent :: __construct();
	}

	/*READ*/

	/*UPDATE*/

	/*DELETE*/

	/*OTHER*/
	public function getAllGallery(){
		parent :: connection();
		$ar = [];
		$MemberDao = new MemberDao();

		$sql = "SELECT id_Gallery,name_Gallery,owner_Gallery FROM GALLERY";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);
		
		while ($row = mysqli_fetch_assoc($sqlExecute)) {
			$tempGallery = new Gallery($row['name_Gallery']);
			$tempGallery->setId($row['id_Gallery']);
			$tempGallery->setOwner($MemberDao->searchById($row['owner_Gallery']));

			array_push($ar, $tempGallery);
		}

		parent :: deconnection();
		return $ar;
	}

	public function getAllMember(){
		parent :: connection();
		$ar = [];

		$sql = "SELECT id_User,login_User,registration_User FROM USER";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);
		
		while ($row = mysqli_fetch_assoc($sqlExecute)) {
			$tempMember = new Member($row['id_User'],$row['login_User'],date_create($row['registration_User']));

			array_push($ar, $tempMember);
		}

		parent :: deconnection();
		return $ar;
	}

	public function getAllLog(){
		parent :: connection();

		$sql = "";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}
}

?>
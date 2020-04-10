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

		$sql = "";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	public function getAllMember(){
		parent :: connection();

		$sql = "";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	public function getAllLog(){
		parent :: connection();

		$sql = "";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}
}

?>
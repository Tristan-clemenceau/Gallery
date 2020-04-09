<?php
/**
 * 
 */
class PersonDAO extends DbObject
{
	
	function __construct()
	{
		parent :: __construct();
	}

	public function test(){
		parent :: connection();

		$sql = "INSERT INTO user ( login_User, registration_User, admin_User, hash_User) VALUES ( 'uytruytruytr', '2020-04-09 00:00:00', '1', 'uytruytruytruytr')";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}
	/*CREATE*/

	/*READ*/

	/*UPDATE*/

	/*DELETE*/

	/*OTHER*/

}

?>
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

	/*CREATE*/

	/*READ*/

	/*UPDATE*/
	public function updateLogin(Person $person){
		parent :: connection();

		$sql = "UPDATE USER SET login_User = '".$person->getLogin()."' WHERE id_User = {$person->getId()}";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	/*DELETE*/

	/*OTHER*/

}

?>
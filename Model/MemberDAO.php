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
	public function test(Member $member){
		parent :: connection();

		$sql = "INSERT INTO USER ( login_User, registration_User, admin_User, hash_User) VALUES ( '".$member->getLogin()."', '".date_format($log->getRegistationDate(),"Y-m-d H:i:s")."', '0', 'UNKNOW')";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	/*READ*/

	/*UPDATE*/

	/*DELETE*/

	/*OTHER*/
}

?>
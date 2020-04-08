<?php
/**
 * 
 */
class Person
{
	private $id;
	private $login;
	private $co;
	
	function __construct()// 1 : id,2 : login
	{
		$numArgs = func_num_args(); //Number arguments
		$args = func_get_args(); //Array arguments

		switch ($numArgs) {
			case 0:
				$this->id = "01240";
				$this->login = "Login";
				break;
			case 1:
				$this->id = $args[0];
				$this->login = "Login";
				break;
			case 2:
				$this->id = $args[0];
				$this->login = $args[1];
				break;
			
			default:
				echo "[ERROR] : ";
				break;
		}
	}

	/*GETTER*/
	public function getId(){
		return $this->id;
	}

	public function getLogin(){
		return $this->login;
	}

	/*SETTER*/
	public function setId($id){
		$this->id = $id;
	}

	public function setLogin($login){
		$this->login = $login;
	}

	/*OTHER*/
	public function display(){
		echo "Id : {$this->id}\t Login : {$this->login}";
	}
}

?>
<?php
/**
 * 
 */
class Person
{
	private $id;
	private $login;
	
	function __construct()
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
				echo "Neutre";
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

	/*OTHER*/
	public function display(){
		echo "Id : {$this->id}\t Login : {$this->login}";
	}
}

?>
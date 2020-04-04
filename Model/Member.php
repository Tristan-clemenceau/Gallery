<?php
/**
 * 
 */
class Member extends Person
{
	private $cc;

	function __construct()
	{
		parent :: __construct();
		$this->cc = 10;
	}

	/*GETTER*/

	/*SETTER*/

	/*OTHER*/
	public function display(){
		echo "Id : ".$this->getId()."\t Login : ".$this->getLogin()."\t test : ".$this->cc;
	}
}
?>
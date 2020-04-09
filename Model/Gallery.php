<?php

/**
 * 
 */
class Gallery
{
	private $name;
	private $owner;
	private $id;
	private $arr_post;
	private $arr_member;

	function __construct()//1 : name , 2: owner , 3: id,4: arr_post,5:arr_member
	{
		$numArgs = func_num_args(); //Number arguments
		$args = func_get_args(); //Array arguments

		switch ($numArgs) {
			case 0:
				$this->name = "UNDEFINED";
				$this->owner = new Person();
				$this->id = "UNDEFINED";
				$this->arr_post= [];
				$this->arr_member= [];
				break;
			case 1:
				$this->name = $args[0];
				$this->owner = new Person();
				$this->id = "UNDEFINED";
				$this->arr_post= [];
				$this->arr_member= [];
				break;
			case 2:
				$this->name = $args[0];
				$this->owner = $args[1];
				$this->id = "UNDEFINED";
				$this->arr_post= [];
				$this->arr_member= [];
				break;
			case 3:
				$this->name = $args[0];
				$this->owner = $args[1];
				$this->id = $args[2];
				$this->arr_post= [];
				$this->arr_member= [];
				break;
			case 4:
				$this->name = $args[0];
				$this->owner = $args[1];
				$this->id = $args[2];
				$this->arr_post= $args[3];
				$this->arr_member= [];
				break;
			case 5:
				$this->name = $args[0];
				$this->owner = $args[1];
				$this->id = $args[2];
				$this->arr_post= $args[3];
				$this->arr_member= $args[4];
				break;
			
			default:
				echo "[ERROR] : [GALLERY] too many or not enought arguments";
				break;
		}
	}
	/*GETTER*/
	public function getName(){
		return $this->name;
	}

	public function getOwner(){
		return $this->owner;
	}

	public function getId(){
		return $this->id;
	}

	public function getArrPost(){
		return $this->arr_post;
	}

	public function getArrMember(){
		return $this->arr_member;
	}

	/*SETTER*/
	public function setName($name){
		$this->name = $name;
	}

	public function setOwner(Person $owner){
		$this->owner = $owner;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setArrPost($arrPost){
		$this->arr_post = $arrPost;
	}

	public function setArrMember($arrMember){
		$this->arr_member = $arrMember;
	}

	/*OTHER*/
	public function display(){
		echo "[GALLERY] name : ".$this->name."\tOwner".$this->owner->display()."\tId : ".$this->id."\t nbPost : ".count($this->arr_post)."\tnbMember".count($this->arr_member);
	}
}

?>
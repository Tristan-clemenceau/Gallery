<?php
/**
 * 
 */
class Member extends Person
{
	private $registrationDate;
	private $arr_Gallery; //all Gallery owned and invited
	private $arr_Owned; //Owner

	function __construct()
	{
		$numArgs = func_num_args(); //Number arguments
		$args = func_get_args(); //Array arguments

		switch ($numArgs) {//1: id ,2:login,3:registrationDate,4:arr_Gallery,5:arr_Owned
			case 0:
				parent :: __construct();
				$this->registrationDate = date_create("2202-05-24");
				$this->arr_Gallery = [];
				$this->arr_Owned = [];
				break;
			case 1:
				parent :: __construct($args[0]);
				$this->registrationDate = date_create("2202-05-24");
				$this->arr_Gallery = [];
				$this->arr_Owned = [];
				break;
			case 2:
				parent :: __construct($args[0],$args[1]);
				$this->registrationDate = date_create("2202-05-24");
				$this->arr_Gallery = [];
				$this->arr_Owned = [];
				break;
			case 3:
				parent :: __construct($args[0],$args[1]);
				$this->registrationDate = $args[2];
				$this->arr_Gallery = [];
				$this->arr_Owned = [];
				break;
			case 4:
				parent :: __construct($args[0],$args[1]);
				$this->registrationDate = $args[2];
				$this->arr_Gallery = $args[3];
				$this->arr_Owned = [];
				break;
			case 5:
				parent :: __construct($args[0],$args[1]);
				$this->registrationDate = $args[2];
				$this->arr_Gallery = $args[3];
				$this->arr_Owned = $args[4];
				break;
			
			default:
				echo "[ERROR] : [MEMBER] too many or not enought arguments";
				break;
		}
		
	}

	/*GETTER*/
	public function getRegistationDate(){
		return $this->registrationDate;
	}

	public function getArrGallery(){
		return $this->arr_Gallery;
	}

	public function getArrOwned(){
		return $this->arr_Owned;
	}

	/*SETTER*/
	public function setId($id){
		parent :: setId($id);
	}

	public function setLogin($login){
		parent :: setLogin($login);
	}

	public function setRegistationDate($date){
		$this->registrationDate = date_create($date);
	}

	/*OTHER*/
	public function addGallery(Gallery $gallery){
		array_push($this->arr_Gallery, $gallery);
	}

	public function addOwned(Gallery $Ogallery){
		array_push($this->arr_Owned, $Ogallery);
	}

	public function display(){
		echo "Id : ".parent :: getId()."\t Login : ".$this->getLogin()."\t Gallery : ".count($this->arr_Gallery)."\t Owned gallery : ".count($this->arr_Owned)."\t registration date : ".date_format($this->registrationDate,"Y/m/d H:i:s");
	}
}
?>
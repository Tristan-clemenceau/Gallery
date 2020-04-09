<?php
/**
 * 
 */
class Admin extends Person
{
	private $arr_gallery;
	private $arr_member;
	private $arr_log;

	function __construct()
	{

		$numArgs = func_num_args(); //Number arguments
		$args = func_get_args(); //Array arguments

		switch ($numArgs) {//1: id ,2:login,3:arr_gallery,4:arr_member,5:arr_Log
			case 0:
				parent :: __construct();
				$this->arr_gallery = [];
				$this->arr_member = [];
				$this->arr_log = [];
				break;
			case 1:
				parent :: __construct($args[0]);
				$this->arr_gallery = [];
				$this->arr_member = [];
				$this->arr_log = [];
				break;
			case 2:
				parent :: __construct($args[0],$args[1]);
				$this->arr_gallery = [];
				$this->arr_member = [];
				$this->arr_log = [];
				break;
			case 3:
				parent :: __construct($args[0],$args[1]);
				$this->arr_gallery = $args[2];
				$this->arr_member = [];
				$this->arr_log = [];
				break;
			case 4:
				parent :: __construct($args[0],$args[1]);
				$this->arr_gallery =$args[2];
				$this->arr_member = $args[3];
				$this->arr_log = [];
				break;
			case 5:
				parent :: __construct($args[0],$args[1]);
				$this->arr_gallery =$args[2];
				$this->arr_member = $args[3];
				$this->arr_log = $args[4];
				break;
			
			default:
				echo "[ERROR] : [ADMIN] too many or not enought arguments";
				break;
		}
		
	}

	/*GETTER*/
	public function getGallery(){
		return $this->arr_gallery;
	}

	public function getMember(){
		return $this->arr_member;
	}

	public function getLog(){
		return $this->arr_log;
	}

	/*SETTER*/
	public function setGallery($ArrGal){
		$this->arr_gallery = $ArrGal;
	}

	public function setMember($ArrMem){
		$this->arr_member = $ArrMem;
	}

	public function setLog($ArrLog){
		$this->arr_log = $ArrLog;
	}

	/*OTHER*/
	public function getNbGallery(){
		return count($this->arr_gallery);
	}

	public function getNbMember(){
		return count($this->arr_member);
	}

	public function getNbLog(){
		return count($this->arr_log);
	}

	public function display(){
		echo "[ADMIN] nbGallery : ".$this->getNbGallery()."\tnbMember : ".$this->getNbMember()."\tnbLog : ".$this->getNbLog();
	}
}

?>
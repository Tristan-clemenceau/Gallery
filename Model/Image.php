<?php
/**
 * 
 */
class Image
{
	
	private $id;
	private $link;

	function __construct()//1:id , 2 : link
	{
		$numArgs = func_num_args(); //Number arguments
		$args = func_get_args(); //Array arguments

		switch ($numArgs) {
			case 0:
				$this->id = "UNDEFINED";
				$this->link = "UNDEFINED";
				break;
			case 1:
				$this->id = $args[0];
				$this->link = "UNDEFINED";
				break;
			case 2:
				$this->id = $args[0];
				$this->link = $args[1];
				break;
			
			default:
				echo "[ERROR] : [IMAGE] too many or not enought arguments";
				break;
		}
	}

	/*GETTER*/
	public function getId(){
		return $this->id;
	}

	public function getLink(){
		return $this->link;
	}

	/*SETTER*/
	public function setId($id){
		$this->id = $id;
	}

	public function setLink($link){
		$this->link = $link;
	}

	/*OTHER*/
	public function display(){
		echo "[Image] id : ".$this->id."\t link : ".$this->link;
	}
}
?>
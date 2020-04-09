<?php

/**
 * 
 */
class Post
{
	private $id;
	private $description;
	private $publisher;
	private $image;

	function __construct()//1: id, 2 : description , 3: publisher,4 : image
	{
		$numArgs = func_num_args(); //Number arguments
		$args = func_get_args(); //Array arguments

		switch ($numArgs) {
			case 0:
				$this->id = "UNDEFINED";
				$this->description = "UNDEFINED";
				$this->publisher = new Person();
				$this->image = new Image();
				break;
			case 1:
				$this->id = $args[0];
				$this->description = "UNDEFINED";
				$this->publisher = new Person();
				$this->image = new Image();
				break;
			case 2:
				$this->id = $args[0];
				$this->description = $args[1];
				$this->publisher = new Person();
				$this->image = new Image();
				break;
			case 3:
				$this->id = $args[0];
				$this->description = $args[1];
				$this->publisher = $args[2];
				$this->image = new Image();
				break;
			case 4:
				$this->id = $args[0];
				$this->description = $args[1];
				$this->publisher = $args[2];
				$this->image = $args[3];
				break;
			default:
				echo "[ERROR] : [Post] too many or not enought arguments";
				break;
		}
	}
	/*GETTER*/
	public function getId(){
		return $this->id;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getPublisher(){
		return $this->publisher;
	}

	public function getImage(){
		return $this->image;
	}

	/*SETTER*/
	public function setId($id){
		$this->id = $id;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function setPublisher(Person $publisher){
		$this->publisher = $publisher;
	}

	public function setImage(Image $image){
		$this->image = $image;
	}

	/*OTHER*/
	public function display(){
		echo "[Post] Id : ".$this->id."\tdescription : ".$this->description."\tpublisher : ".$this->publisher->display()."\timage : ".$this->image->display();
	}
	
}

?>
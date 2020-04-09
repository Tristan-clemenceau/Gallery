<?php

/**
 * 
 */
class Log
{
	private $id;
	private $dateReport;
	private $action;
	private $severity;
	
	function __construct()//1: id,2: date report,3: action,4:severity
	{
		$numArgs = func_num_args(); //Number arguments
		$args = func_get_args(); //Array arguments

		switch ($numArgs) {
			case 0:
				$this->id ="UNDEFINED";
				$this->dateReport = date_create("2202-05-24");
				$this->action= "UNDEFINED";
				$this->severity= "UNDEFINED";
				break;
			case 1:
				$this->id = $args[0];
				$this->dateReport = date_create("2202-05-24");
				$this->action= "UNDEFINED";
				$this->severity= "UNDEFINED";
				break;
			case 2:
				$this->id = $args[0];
				$this->dateReport = $args[1];
				$this->action= "UNDEFINED";
				$this->severity= "UNDEFINED";
				break;
			case 3:
				$this->id = $args[0];
				$this->dateReport = $args[1];
				$this->action= $args[2];
				$this->severity= "UNDEFINED";
				break;
			case 4:
				$this->id = $args[0];
				$this->dateReport = $args[1];
				$this->action= $args[2];
				$this->severity= $args[3];
				break;
			
			default:
				echo "[ERROR] : [LOG] too many or not enought arguments";
				break;
		}
	}
	/*GETTER*/
	public function getId(){
		return $this->id;
	}

	public function getDateReport(){
		return $this->dateReport;
	}

	public function getAction(){
		return $this->action;
	}

	public function getSeverity(){
		return $this->severity;
	}

	/*SETTER*/
	public function setId($id){
		$this->id = $id;
	}

	public function setDateReport($dateReport){
		$this->dateReport = $dateReport;
	}

	public function setAction($action){
		$this->action = $action;
	}

	public function setSeverity($severity){
		$this->severity = $severity;
	}

	/*OTHER*/
	public function display(){
		echo "[LOG] : id : ".$this->id."\tDateReport : ".date_format($this->dateReport,"Y-m-d H:i:s")."\tAction : ".$this->action."\tSeverity : ".$this->severity;
	}
}

?>
<?php
/**
 * Connection object
 */
class DbObject
{
	private $co;
	private $host;
	private $user;
	private $dataBaseName;
	private $password;

	function __construct(){
		$this->host = "";
		$this->user = "";
		$this->dataBaseName = "";
		$this->password = "";
	}

	function connection(){
		$this->co = mysqli_connect($this->host,$this->user,$this->password,$this->dataBaseName) or die("Probleme connection avec la bd");
	}

	function deconnection(){
		mysqli_close($this->co);
	}

	function getCo(){
		return $this->co;
	}
}
?>
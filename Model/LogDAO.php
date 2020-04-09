<?php
/**
 * 
 */
class LogDAO extends DbObject
{
	
	function __construct()
	{
		parent :: __construct();
	}

	/*CREATE*/
	public function create(Log $log){
		parent :: connection();

		$sql = "INSERT INTO LOG (dte_Log,action_Log,severity_Log) VALUES ('".date_format($log->getDateReport(),"Y-m-d H:i:s")."','{$log->getAction()}','{$log->getSeverity()}')";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		$id = mysqli_insert_id(parent :: getCo());

		$log->setId($id);

		parent :: deconnection();
		
		return $log;
	}

	/*READ*/
	public function searchById($id){
		parent :: connection();

		$sql = "SELECT id_Image,link_Image FROM IMAGE WHERE id_Image = $id";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);
		$row = mysqli_fetch_row($sqlExecute);

		$image = new Image($row[0],$row[1]);

		parent :: deconnection();

		return $image;
	}

	/*UPDATE*/
	public function updateLink(Image $img){
		parent :: connection();

		$sql = "UPDATE IMAGE SET link_Image = '".$img->getLink()."' WHERE id_Image = ".$img->getId();
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	/*DELETE*/
	public function delete(Image $img){
		parent :: connection();

		$sql = "DELETE FROM IMAGE WHERE id_Image = {$img->getId()} ";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	/*OTHER*/
}

?>
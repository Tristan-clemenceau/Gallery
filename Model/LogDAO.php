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

		$sql = "SELECT id_Log,dte_Log,action_Log,severity_Log FROM LOG WHERE id_Log = $id";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);
		$row = mysqli_fetch_row($sqlExecute);

		$log = new Log($row[0],date_create($row[1]),$row[2],$row[3]);

		parent :: deconnection();

		return $log;
	}

	/*UPDATE*/
	public function updateDateLog(Log $log){
		parent :: connection();

		$sql = "UPDATE LOG SET dte_Log = '".date_format($log->getDateReport(),"Y-m-d H:i:s")."' WHERE id_Log = ".$log->getId();
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	public function updateActionLog(Log $log){
		parent :: connection();

		$sql = "UPDATE LOG SET action_Log = '".$log->getAction()."' WHERE id_Log = ".$log->getId();
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	public function updateSeverityLog(Log $log){
		parent :: connection();

		$sql = "UPDATE LOG SET severity_Log = '".$log->getSeverity()."' WHERE id_Log = ".$log->getId();
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	/*DELETE*/
	public function delete(Log $log){
		parent :: connection();

		$sql = "";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	/*OTHER*/
}

?>
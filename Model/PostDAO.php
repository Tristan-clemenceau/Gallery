<?php
/**
 * 
 */
class PostDAO extends DbObject
{
	
	function __construct()
	{
		parent :: __construct();
	}

	/*CREATE*/

	/*READ*/

	/*UPDATE*/
	public function updateDescription(Post $post){
		parent :: connection();

		$sql = "UPDATE POST SET description_Post = '".$post->getDescription()."' WHERE id_Post = ".$post->getId();
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	/*DELETE*/
	public function delete(Post $post){
		parent :: connection();

		$sql = "DELETE FROM POST WHERE id_Post = {$post->getId()} ";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	/*OTHER*/
}

?>
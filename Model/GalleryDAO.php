<?php
/**
 * 
 */
class GalleryDAO extends DbObject
{
	
	function __construct()
	{
		parent :: __construct();
	}

	/*CREATE*/

	/*READ*/

	/*UPDATE*/
	public function updateName(Gallery $gallery){
		parent :: connection();

		$sql = "UPDATE GALLERY SET name_Gallery = '".$gallery->getName()."' WHERE id_Gallery = ".$gallery->getId();
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	public function updateOwner(Gallery $gallery){
		parent :: connection();

		$sql = "UPDATE GALLERY SET owner_Gallery = '".$gallery->getOxner()->getId()."' WHERE id_Gallery = ".$gallery->getId();
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	/*DELETE*/
	public function delete(Gallery $gallery){
		parent :: connection();

		$sql = "DELETE FROM GALLERY WHERE id_Gallery = {$gallery->getId()} ";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	/*OTHER*/
	public function getAllPost(){
		parent :: connection();

		$sql = "";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	public function getAllMember(){
		parent :: connection();

		$sql = "";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}
}

?>
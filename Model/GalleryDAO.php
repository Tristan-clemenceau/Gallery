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
	public function create($name,$ownerID){
		parent :: connection();

		$sql = "INSERT INTO GALLERY (name_Gallery,owner_Gallery) VALUES ( '{$name}', '{$ownerID}')";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		$id = mysqli_insert_id(parent :: getCo());

		$gallery = new Gallery($name);
		$gallery->setId($id);

		$sql = "INSERT INTO MEMBER (id_Gallery,id_User) VALUES ( '{$id}', '{$ownerID}')";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
		return $gallery;
	}
	/*READ*/
	public function alreadyTaken($name){
		parent :: connection();

		$ok = false;

		$sql = "SELECT * FROM GALLERY WHERE name_Gallery = '{$name}'";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		$row = mysqli_num_rows($sqlExecute);

		if($row != 0){
			$ok = true;
		}

		parent :: deconnection();

		return $ok;
	}

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
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

	public function getGalleriesOwnedFromIdUser($idUser){
		parent :: connection();
		$arGallery = [];

		$sql = "SELECT g.id_Gallery,g.name_Gallery FROM GALLERY g,USER u WHERE g.owner_Gallery = u.id_User AND u.id_User = {$idUser}";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);
		
		while ($row = mysqli_fetch_assoc($sqlExecute)) {
			$tempGallery = new Gallery($row['name_Gallery']);
			$tempGallery->setId($row['id_Gallery']);

			array_push($arGallery, $tempGallery);
		}

		parent :: deconnection();
		return $arGallery;
	}

	public function getGalleriesMemberFromIdUser($idUser){
		parent :: connection();
		$arGallery = [];

		$sql = "SELECT g.id_Gallery,g.name_Gallery FROM GALLERY g, MEMBER m,USER u WHERE g.id_Gallery = m.id_Gallery AND m.id_User = u.id_User AND u.id_User = {$idUser} AND g.id_Gallery NOT IN (SELECT g.id_Gallery FROM GALLERY g,USER u WHERE g.owner_Gallery = u.id_User AND u.id_User = {$idUser})";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);
		
		while ($row = mysqli_fetch_assoc($sqlExecute)) {
			$tempGallery = new Gallery($row['name_Gallery']);
			$tempGallery->setId($row['id_Gallery']);

			array_push($arGallery, $tempGallery);
		}

		parent :: deconnection();
		return $arGallery;
	}

	public function getGaleryByName($name){
		parent :: connection();

		$sql = "SELECT id_Gallery,name_Gallery,owner_Gallery FROM GALLERY WHERE name_Gallery ='{$name}'";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		$row = mysqli_fetch_row($sqlExecute);

		$gallery = new Gallery($name);
		$gallery->setId($row[0]);
		$id = $row[2];

		parent :: deconnection();

		$memberDAO = new MemberDAO();
		$gallery->setOwner($memberDAO->searchById($id));

		return $gallery;
	}

	public function isMemberFromGallery($idPost,$idMember){
		parent :: connection();

		$ok = false;

		$sql = "SELECT m.id_User FROM  MEMBER m WHERE m.id_Gallery = ( 	SELECT p.id_Gallery FROM POST p WHERE p.id_Post = {$idPost}) AND m.id_User = {$idMember}";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		$row = mysqli_num_rows($sqlExecute);

		if($row != 0){
			$ok = true;
		}

		parent :: deconnection();

		return $ok;
	}

	public function isMemberFromGalleryWithoutPost($idMember,$idGallery){
		parent :: connection();

		$ok = false;

		$sql = "SELECT m.id_User FROM  MEMBER m WHERE m.id_Gallery = {$idGallery} AND m.id_User = {$idMember}";
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

	public function getAllMember($idGallery){
		parent :: connection();
		$arMember = [];

		$sql = "SELECT u.id_User,u.login_User FROM MEMBER m, USER u WHERE m.id_User = u.id_User AND m.id_Gallery = {$idGallery}";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);
		
		while ($row = mysqli_fetch_assoc($sqlExecute)) {
			$tempMember = new Member($row['id_User'],$row['login_User']);

			array_push($arMember, $tempMember);
		}

		parent :: deconnection();
		return $arMember;
	}
}

?>
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
	public function create($desc,$idPublisher,$idGallery,$idImage){
		parent :: connection();

		$sql = "INSERT INTO POST (description_Post,publisher_Post,id_Gallery,id_Image) VALUES ('{$desc}',{$idPublisher},{$idGallery},{$idImage})";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	/*READ*/
	public function getPostById($idUser,$idGallery,$login){
		//array de post
		parent :: connection();
		$arPost = array();

		$sql = "SELECT i.id_Image,i.link_Image,p.id_Post,p.description_Post FROM IMAGE i, POST p WHERE i.id_Image = p.id_Image AND p.publisher_Post = {$idUser} AND p.id_Gallery = {$idGallery}";

		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		while ($row = mysqli_fetch_assoc($sqlExecute)) {

			$tempImage = new Image($row['id_Image'],$row['link_Image']);
			$tempPost = new Post($row['id_Post'],$row['description_Post']);
			$tempMember = new Member($idUser,$login);

			$tempPost->setImage($tempImage);
			$tempPost->setPublisher($tempMember);

			array_push($arPost, $tempPost);
		}

		parent :: deconnection();
		return $arPost;
	}

	/*UPDATE*/
	public function updateDescription(Post $post){
		parent :: connection();

		$sql = "UPDATE POST SET description_Post = '".$post->getDescription()."' WHERE id_Post = ".$post->getId();
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
	}

	/*DELETE*/
	public function delete($idPost){
		parent :: connection();

		/*GET INFORMATION*/
		$sql = "SELECT p.id_Image FROM POST p WHERE p.id_Post = {$idPost}";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		$row = mysqli_fetch_row($sqlExecute);
		$idImage = $row[0];

		$sql = "SELECT i.link_Image FROM IMAGE i WHERE i.id_Image = {$idImage}";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);
		
		$row = mysqli_fetch_row($sqlExecute);
		$LinkImage = $row[0];

		$linkTodelete = "../Public/Images/Uploads/{$LinkImage}";

		unlink($linkTodelete);

		/*DELETE POST AND IMAGE*/
		$sql = "DELETE FROM POST WHERE id_Post = {$idPost}";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		$sql = "DELETE FROM IMAGE WHERE id_Image = {$idImage}";
		$sqlExecute = mysqli_query(parent :: getCo(),$sql);

		parent :: deconnection();
		
	}

	/*OTHER*/
}

?>
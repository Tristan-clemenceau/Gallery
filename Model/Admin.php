<?php
/**
 * 
 */
class Admin extends Person
{
	private $arr_gallery;
	private $arr_member;

	function __construct()
	{
		parent :: __construct();
		$this->arr_gallery = [];
		$this->arr_member = [];
	}

	/*GETTER*/
	public function getGallery(){
		return $this->arr_gallery;
	}

	public function getMember(){
		return $this->arr_member;
	}

	/*SETTER*/

	/*OTHER*/
	public function getNbGallery(){
		return count($this->arr_gallery);
	}

	public function getNbMember(){
		return count($this->arr_member);
	}
}

?>
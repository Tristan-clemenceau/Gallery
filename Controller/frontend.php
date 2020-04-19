<?php
/*CLASS IMPORT*/
//NORMAL
require_once('Model/connection.php');
require_once('Model/Person.php');
require_once('Model/Member.php');
require_once('Model/Gallery.php');
require_once('Model/Image.php');
require_once('Model/Post.php');
require_once('Model/Log.php');
require_once('Model/Admin.php');

//DAO
require_once('Model/ImageDAO.php');
require_once('Model/LogDAO.php');
require_once('Model/AdminDAO.php');
require_once('Model/MemberDAO.php');

/*FUNCTION*/

function homeView(){
	require('View/homeView.php');
}

function testView(){
	require('View/UserView.php');
}

function logout(){
	/*DELETE OLD*/
	session_unset();
	session_destroy();
	header("Location: index.php");
	exit();
}

function account(){
	require('View/UserAccount.php');
}
?>
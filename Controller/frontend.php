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

/*FUNCTION*/

function test(){
	require('View/Fr/home.html');
}

?>
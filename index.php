<?php
require_once('Model/connection.php');
require_once('Model/Person.php');
require_once('Model/Member.php');
require_once('Model/Gallery.php');
require_once('Model/ImageDAO.php');
require_once('Model/Image.php');
require_once('Model/Post.php');
require_once('Model/Log.php');
require_once('Model/Admin.php');

$db = new DbObject();
$test = new Person("aaa");
$to = new Member();
$ga = new Gallery();
$testDAO = new ImageDAO();
$image = new Image();
$post = new Post();
$log = new Log();
$adm = new Admin();

$db->connection();
$test->display();
echo "<br />";
$to->display();
$to->setLogin('rap');
$to->addGallery($ga);
echo "<br />";
$to->display();
echo "<br />";
$testDAO->test();
$image->display();
echo "<br />";
$post->display();
echo "<br />";
$log->display();
echo "<br />";
$ga->display();
echo "<br />";
$adm->display();
/*$ar = [];

array_push($ar, $to);

print_r($ar);*/

?>
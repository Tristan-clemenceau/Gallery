<?php
require_once('Model/connection.php');
require_once('Model/Person.php');
require_once('Model/Member.php');
require_once('Model/Gallery.php');

$db = new DbObject();
$test = new Person("aaa");
$to = new Member();
$ga = new Gallery();

$db->connection();
$test->display();
echo "<br />";
$to->display();
$to->setLogin('rap');
$to->addGallery($ga);
echo "<br />";
$to->display();

/*$ar = [];

array_push($ar, $to);

print_r($ar);*/

?>
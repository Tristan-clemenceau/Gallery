<?php
require_once('Model/connection.php');
require_once('Model/Person.php');
require_once('Model/Member.php');

$db = new DbObject();
$test = new Person("aaa");
$to = new Member();

$db->connection();
$test->display();
echo "<br />";
$to->display();
$to->setLogin('rap');
echo "<br />";
$to->display();

/*$ar = [];

array_push($ar, $to);

print_r($ar);*/

?>
<?php
require_once('Model/connection.php');
require_once('Model/Person.php');
require_once('Model/Member.php');
require_once('Model/Gallery.php');
require_once('Model/ImageDAO.php');
require_once('Model/LogDAO.php');
require_once('Model/Image.php');
require_once('Model/Post.php');
require_once('Model/Log.php');
require_once('Model/Admin.php');

$db = new DbObject();
$test = new Person("aaa");
$to = new Member();
$ga = new Gallery();
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
$image->display();
echo "<br />";
$post->display();
echo "<br />";
$log->display();
echo "<br />";
$ga->display();
echo "<br />";
$adm->display();

/*TEST DAO*/
$testDAO = new ImageDAO();
$testLog= new LogDAO();
//$testimg = $testDAO->create("https://stackoverflow.com/questions/2266604/select-last-insert-id");
//$testimg->display();

$testimg = $testDAO->searchById(1);
echo "<br />";
$testimg->display();
$testimg->setLink("ghfjdkghjkfdhlkgfds");
$testDAO->updateLink($testimg);
echo "<br />";
$testimg->display();
$testDAO->delete($testimg);
$testDAOlog = $testLog->create($log);
echo "<br />";
$testDAOlog->display();
/*$ar = [];

array_push($ar, $to);

print_r($ar);*/

?>
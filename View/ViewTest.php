<?php 
 $linkCSS = [];
 $linkJS = [];
 array_push($linkCSS, "Public/CSS/default.css");
 array_push($linkJS, "test");
/*CLASS IMPORT*/
require_once('Model/Multilingual.php');
/*CODE*/
if(!isset($_SESSION)) 
    { 
        //session_start(); 
        echo "unset";
    }else{
$title = $multilingualArray['homeView'][$_SESSION['Lang']]['title'];
echo $title;
    }
	  $lang = "fr";
	 //$linkCSS = "Public/CSS/default.css";
	  ?>
<?php ob_start(); 
print_r($multilingualArray['homeView']['fr']) ;
print_r($linkCSS) ;
print_r($linkJS) ;?>
<h2>TEST</h2>
<?php $content = ob_get_clean(); ?>

<?php require('View/template.php');?>
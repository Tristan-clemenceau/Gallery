<?php 
 
/*CLASS IMPORT*/
require_once('Model/Multilingual.php');
/*CODE*/
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }else{
$title = $multilingualArray['HOME'][$_SESSION['Lang']]['title'];
    }
	  $lang = "fr";
	  $linkCSS = "Public/CSS/default.css";
	  ?>
<?php ob_start(); 
print_r($multilingualArray['HOME']['fr']) ;?>
<h2>TEST</h2>
<?php $content = ob_get_clean(); ?>

<?php require('View/template.php');?>
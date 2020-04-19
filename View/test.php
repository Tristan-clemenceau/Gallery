<?php

/*IMPORT*/ 
require_once('../Model/Person.php');
require_once('../Model/Member.php');

session_start();
echo $_SESSION['member']->getId();
echo $_SESSION['member']->getLogin();
echo date_format($_SESSION['member']->getRegistationDate(),"Y/m/d H:i:s");
?>
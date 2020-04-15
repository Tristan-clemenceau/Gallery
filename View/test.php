<?php

session_start();
//session start

// remove all session variables
session_unset();

// destroy the session
session_destroy();

?>
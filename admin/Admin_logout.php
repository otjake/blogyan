<?php
require_once ("includes/functions.php");
//start session
session_start();

//unset arrays
$_SESSION=array();

//clear cookies
if(isset($_COOKIE[session_name()])){
    setcookie(session_name(),'',time()-42000,'/');
}
//destroy session

session_destroy();

page_redirect('Admin_login.php?logout=1');



?>


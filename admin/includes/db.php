<?php
require_once ("config.php");
$connection=new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if(!$connection){
    die("unable to connect::". mysql_error());
}else{
    echo "";
}
?>
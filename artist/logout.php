<?php

include('../config.php');

session_destroy();

if(count($_SESSION) == 0){
    $_SESSION=array();
    session_destroy();
}

redirect('login.php','js');
?>
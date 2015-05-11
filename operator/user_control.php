<?php
require '../config.php';

if(($_SESSION['user_type'] ==1) || ($_SESSION['user_type'] ==2 )) {
}else{
    redirect('login.php');
}
?>
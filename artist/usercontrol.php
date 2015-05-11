<?php
require '../config.php';
if(($_SESSION['user_type'] == 3) OR $_SESSION['user_type'] == 2 OR $_SESSION['user_type'] == 1) {
    $uid = $_SESSION['userid'];
}else{
    redirect('login.php');
}
?>

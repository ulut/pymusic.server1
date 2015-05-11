<?php
require '../config.php';
    if ($_SESSION['user_type'] !=1) {
        redirect('login.php');
    }
?>
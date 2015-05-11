<?php
include('../config.php');

if(isset($_POST['submit'])){
	
	$username = trim(getpost("username"));
	$password = trim(getpost("password"));
	
    if (strlen($username) * strlen($password)){
    $passwordmd5 = md5($password);
	}
	

//    $user = $db->select_one("users","username='".$username."' AND password='".$password."'");
    $user = $db->select_one("users"," ( username='".$username."' OR email like'".$username."' OR phone like'".$username."' ) AND password='".$passwordmd5."'");

    // log login
    $log_flag = ($user ? 1:0);

    $up = "Username: ".$username." password : ".$password;

    $date_view = date('d-m-Y');
    $time_viev = date('H-i-s');
    $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];// айпи пользователя
    $REQUEST_URI = $_SERVER['REQUEST_URI']; // определяем запрашиваемую страницу
    $message = '';
    if($log_flag == 1){
        $message = 'Вход выполнен в панель операторов!';
        $userid = $user['id'];
    }elseif($log_flag == 0){
        $message = 'Ошибка при входе в панель операторов!';
        $userid = " no id";
    }
    $insert = array(
        "remote_addr" => $REMOTE_ADDR,
        "request_uri" => $REQUEST_URI,
        "message" => $message.$up,
        "date_view" => $date_view,
        "time_view" => $time_viev,
        "userid" => $userid
    );
    $result = $db->insert(DB_PREFIX ."logs",$insert);
    // log login end

    if($user){
        if(($user['status'] == 1) && ($user['user_type'] == 2 || $user['user_type'] == 1)){

            session_start();
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['userid']    = $user['id'];
            $_SESSION['user_name'] = $user['username'];
            redirect('index.php','js');
        }
        else{
            echo "Invalid username or password";
        }

    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="login.php" method="post">
                        <div class="form-group">
                            <input class="form-control" placeholder="Username/Email/Телефон" name="username" autofocus type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" >
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-lg btn-success btn-block" name="submit" value="Login"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="../admin/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../admin/dist/js/sb-admin-2.js"></script>

</body>

</html>

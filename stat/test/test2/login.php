<?php
//include('ipcontrol.php');
include('../../config.php');
if($_POST['submit']){
	$username = $_POST["username"];
	$password = md5($_POST["password"]);

    $user = $db->select_one("users","username='".$username."' OR phone='".$username."' OR email='".$username."' AND password='".$password."'");
    if($user){
        session_start();
        $_SESSION['user_type'] = $user['user_type'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        redirect('index.php','js');

    }else{
        echo "Invalid username or password";
    }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Test</title>
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="css/font-awesome.css"/>
    <link rel="stylesheet" href="css/sanitize.css"/>

    <link rel="stylesheet" href="css/style.css"/>
</head>

<body>
<div class="container" style="margin-top:40px">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Авторизация</h4>
                </div>
                <div class="panel-body">
                    <form role="form" action="#" method="POST">
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="USERNAME" name="loginname" type="text">
												<span class="input-group-addon">
													<i class="fa fa-user"></i>
												</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="PASSWORD" name="password" type="password">
												<span class="input-group-addon">
													<i class="fa fa-unlock-alt"></i>
												</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="SIGN IN">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>


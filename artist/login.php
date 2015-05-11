<?php
include('../config.php');
$error_msg = NULL;

//echo "usertype: ".$_SESSION['user_type']." userid: ".$_SESSION['userid'];
if(isset($_POST['username'])){
    $username = trim(getpost("username"));
	$password = trim(getpost("password"));
	if (strlen($username) * strlen($password)){
        $passwordmd5 = md5($password);

    $user = $db->select_one("users","status=1 and ( username='".$username."' OR email like'".$username."' OR phone like'".$username."' ) AND password='".$passwordmd5."'");

        // log login
        $log_flag = ($user ? 1:0);

        $up = "Username: ".$username." password : ".$password;

        $date_view = date('d-m-Y');
        $time_viev = date('H-i-s');
        $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];// айпи пользователя
        $REQUEST_URI = $_SERVER['REQUEST_URI']; // определяем запрашиваемую страницу
        $message = '';
        if($log_flag == 1){
            $message = 'Вход выполнен в панель артистов!';
            $userid = $user['id'];
        }elseif($log_flag == 0){
            $message = 'Ошибка при входе в панель артистов!';
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
			$_SESSION['user_type'] = $user['user_type'];
            $_SESSION['userid']    = $user['id'];
            $_SESSION['user_name'] = $user['username'];
			$today = date("Y-m-d");
			$singer_list = $db->selectpuresql("select a.* from artist as a inner join user_tie as ut on a.id=ut.singer_id where ut.user_id='".$user['id']."' and ut.is_always = 1 OR (ut.from_date<='".$today."' and ut.to_date>='".$today."')");
			$_SESSION['singer_list'] = $singer_list;
			$singer_ids = "0";
			foreach($singer_list as $singer){
				$singer_ids .= ", ".$singer['id'];
			}
			$_SESSION['singer_ids'] = $singer_ids;
       		redirect('index.php');
    }else{
        $error_msg = "Бир нерсеси туура эмес болуп жатат";
    }
	} else $error_msg = "Бир нерсеси туура эмес болуп жатат";

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="../css/style.css"/>

</head>

<body class="login">

<div class="content container login">

    <div class="row">
        <div class="col l4 offset-l4 m6 offset-m3 s12 login-logo">
            <img src="../images/logo_white.png" alt=""/>
        </div>
    </div>
    <div class="row">

        <div class="col s12 m6 l4 offset-l4 offset-m3">
            <div class="card z-depth-2 stats">
                <div class="card-content">
                    <h4 class="card-title center">
                        Кош келиңиз!
                    </h4>
					<?php if ($error_msg) echo $error_msg; ?>
                    <div class="row">
                        <form name="form1" method="post" class="col l12 m12 s12">

                            <div class="input-field col s12 m12 l12">
                                <input name="username" id="username" type="text" class="validate col l12 s12 m12">
                                <label for="username">Логин / Телефон / E-mail</label>
                            </div>
                            <div class="input-field col s12 m12 l12">
                                <input name="password" id="password" type="password" class="validate col l12 s12 m12">
                                <label for="password">Пароль</label>
                            </div>
                            <div class="input-field col s12 m12 l12 center">
                                <button class="btn waves-effect waves-light" type="submit" name="action">ОК
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

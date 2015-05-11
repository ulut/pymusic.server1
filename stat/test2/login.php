<?php
include('../../config.php');
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

                    <div class="row">
                        <form class="col l12 m12 s12">

                            <div class="input-field col s12 m12 l12">
                                <input id="name" type="text" class="validate col l12 s12 m12">
                                <label for="name">Логин / Телефон / E-mail</label>
                            </div>
                            <div class="input-field col s12 m12 l12">
                                <input id="password" type="text" class="validate col l12 s12 m12">
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

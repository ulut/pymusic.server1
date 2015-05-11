<?php
include("main_header.php");
include("header.php");

if(isset($_POST['submit_form'])){
    $id = $_SESSION['userid'];
    $user_name = getpost('user_name');
    $full_name = getpost('full_name');
    $email = getpost('email');
    $phone = getpost('phone');

    $password = getpost('password');
    $password2 = getpost('password2');
    if($password != $password2){
        echo $error .= "Пароли не совпадают попробуйте еще раз!";
    }
    $user_password = md5($password);
    $update = array(
        "username" => $user_name,
        "password" => $user_password,
        "user_type" => 3,
        "status" => 1,
        "full_name" => $full_name,
        "email" => $email,
        "phone" => $phone,
        "p" => $password
    );
    $result = $db->update("users",$update,"id='".$id."'");

    redirect("index.php","js");
}
?>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Изменить</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default col-lg-6 no-padding">
                <form role="form" action="user_password.php" method="post">
                    <?php
                    $id = $_SESSION['userid'];
                    $item = $db->select_one("users","id='".$id."' AND user_type<>1 AND status=1");
                    ?>
                    <div class="form-group input-group">
                        <span class="input-group-addon">Логин </span>
                        <input type="text" class="form-control" name="user_name" value="<?=$item['username'];?>">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon">ФИО </span>
                        <input type="text" class="form-control" name="full_name" value="<?=$item['full_name'];?>">
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon">Email </span>
                        <input type="email" class="form-control" name="email" value="<?=$item['email'];?>">
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon">Телефон </span>
                        <input type="text" class="form-control" name="phone" value="<?=$item['phone'];?>">
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon">Пароль </span>
                        <input type="password" class="form-control" name="password" required="required">
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon">Повторите пароль </span>
                        <input type="password" class="form-control" name="password2" required="required">
                    </div>

                    <button type="submit" name="submit_form" class="btn btn-default submit-btn pull-right">Сохранить</button>
                </form>

                <!-- /.panel-heading -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

        <?php
        include("footer.php");
        ?>

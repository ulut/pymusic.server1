<?php
include("header.php");
?>
    <!-- Navigation -->
    <?php
    include("nav.php");
    ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Добавить редактора</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default col-lg-6 no-padding">
                    <form role="form">
                        <div class="form-group input-group">
                            <span class="input-group-addon">Имя </span>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon">Фамилия </span>
                            <input type="text" class="form-control">
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon">Email </span>
                            <input type="email" class="form-control">
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon">Password </span>
                            <input type="password" class="form-control">
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon">Категория </span>
                            <select class="form-control" id="sel1">
                                <option>Новости</option>
                                <option>Тендеры</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default submit-btn pull-right">Добавить</button>
                    </form>

                    <!-- /.panel-heading -->

                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

    <?php
    include("footer.php");
    ?>

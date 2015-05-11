<?php
include('user_control.php');
include("header.php");
$singer = $db->select("artist");
?>
    
<?php
include("nav.php");
?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Пользователи</h4>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Список всех пользователей
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover tex">
                                <thead>
                                <tr>
                                    <th class="col-lg-2">Логин</th>
                                    <th class="col-lg-2">ФИО</th>
                                    <th class="col-lg-2">Email</th>
                                    <th class="col-lg-2">Телефон</th>
                                    <th class="col-lg-2">Управление пользователями</th>
                                    <th class="col-lg-2">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                        <?php
                                $table = $db->select("users","user_type<>1 AND status=1");
                                foreach($table as $item){
                                $user_id = $item['id'];
                        ?>

                        <script>
                            $(function() {
                                $( "#from<?php echo $user_id; ?>" ).datepicker({
                                    changeMonth: true,
                                    selectOtherMonths: true,
                                    showOtherMonths: true,
                                    numberOfMonths: 1,
                                    onClose: function( selectedDate ) {
                                        $( "#to<?php echo $user_id; ?>" ).datepicker( "option", "minDate", selectedDate );
                                    }
                                });
                                $( "#to<?php echo $user_id; ?>" ).datepicker({
                                    changeMonth: true,
                                    selectOtherMonths: true,
                                    showOtherMonths: true,
                                    numberOfMonths: 1,
                                    onClose: function( selectedDate ) {
                                        $( "#from<?php echo $user_id; ?>" ).datepicker( "option", "maxDate", selectedDate );
                                    }
                                });
                            });
                        </script>


                                <tr class="odd gradeX">
                                    <td><?=$item['username'];?></td>
                                    <td><?=$item['full_name'];?></td>
                                    <td><?=$item['email'];?></td>
                                    <td class="text-info"><?=$item['phone'];?></td>

                                    <td class="col-md-1">
                                        <a href="user_tie_manager.php?id=<?php echo $item['id'];?>">Посмотреть</a>
                                    </td>
                                    <td>
                                        <a href="user_edit.php?id=<?=$item['id'];?>" class="btn btn-info col-lg-5">Изменить</a>
                                        <a onclick="return confirm('Вы уверены?')" href="user_delete.php?id=<?=$item['id'];?>" class="btn btn-info col-lg-5" >Удалить</a>
                                    </td>
                                </tr>
                        <?php
                                } // end of foreach(userlist);
                        ?>
                                </tbody>
                            </table>
                        </div><!-- dataTable_wrapper -->

                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->



    <?php
    include("footer.php");
    ?>
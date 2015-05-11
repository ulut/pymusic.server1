<?php
$result = $db-> selectpuresql('select a.id as artist_id, a.name as artist_name from artist as a INNER JOIN user_tie as tie ON a.id = tie.singer_id where tie.user_id =  '.$_SESSION['id'].'');

?>

<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?=$_SESSION['username']; ?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right hidden-xs">
               <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Личный Кабинет</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Настройки</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Выход</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="index.php">Башкы бет</a>
                        </li>

                        <li>
                            <a href="upload_song.php">Жаңы ыр кошуу</a>
                        </li>

                        <li>
                            <a href="#">Ырчылар<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php
                                    foreach ($result as $artists) {
                                ?>

                                <li>
                                    <a href="songs_list.php?art_id=<?=$artists['artist_id'];?>"><?=$artists['artist_name'];?></a>
                                </li>

                                <?php
                                    }
                                ?>
                            </ul>

                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
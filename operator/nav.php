<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Pymusic</a>
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
                        <li><a href="../operator/logout.php"><i class="fa fa-sign-out fa-fw"></i> Выход</a>
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
                        <?php
                        if($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2){


                            ?>
                        <li>
                            <a href="index.php">Главная</a>
                        </li>

                        <li>
                            <a href="#">Ырлар<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="song_add.php">Жаны ыр кошуу</a>
                                </li>

                                <li>
                                    <a href="song_list.php">Бардык ырлар</a>
                                </li>

                                <li>
                                    <a href="unproved_songs.php">Далилденген эмес ырлар</a>
                                </li>

                                <li>
                                    <a href="declined_song.php"">Кабыл алынбаган (ОТКАЗ) ырлар</a>
                                </li>

                            </ul>
<!--                            <a href="song_list.php">Ырлар</a>-->
                        </li>
                        <li>
                            <a href="#">Users<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="user_add.php">Жаны user кошуу</a>
                                </li>

                                <li>
                                    <a href="user_list.php">Бардык users</a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="#">Ырчылар <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="artist_list.php">Ырчылар</a>
                                </li>
                                <li>
                                    <a href="artist_new.php">Жаны ырчы кошуу</a>
                                </li>
                            </ul>
<!--                            <a href="artist_list.php">Ырчылар</a>-->
                        </li>
<!--                        <li>-->
<!--                            <a href="artist_list.php">Ырчылар</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="artist_new.php">Жаны ырчы кошуу</a>-->
<!--                        </li>-->
                        <?php
                            }
                        ?>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
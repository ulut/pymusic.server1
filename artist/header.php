<div class="header white z-depth-1">
    <div class="container">
        <div class="row">
            <nav>

                <div class="nav-wrapper">
                    <a href="index.php" class="brand-logo">
                        <img src="../images/logo_red_on_white.png" alt=""/>
                    </a>
                    <ul class="right hide-on-med-and-down">
                        <li class="<?php if(PHP_SELF == '/artist/index.php') echo 'active'; ?>">
                            <a href="index.php">
                                <span>Башкы бет</span>
                            </a>
                        </li>
                        <li class="<?php if(PHP_SELF == '/artist/compare.php') echo "active"; ?>">
                            <a href="compare.php">
                                <span>Салыштыруу</span>
                            </a>
                        </li>
                        <li class="<?php if(PHP_SELF == '/artist/songs.php') echo "active"; ?>">
                            <a href="songs.php">
                                <span>Ырларым</span>
                            </a>
                        </li>
                        <li class="<?php if(PHP_SELF == '/artist/add_song.php') echo "active"; ?>">
                            <a href="add_song.php">
                                <span>Ыр кошуу</span>
                            </a>
                        </li>

                        <li class="logout">
                            <a href="logout.php"><i class="mdi-action-exit-to-app"></i></a>
                        </li>
                        <!-- Dropdown Trigger -->
                        <ul id='dropdown1' class='dropdown-content'>
                            <li><a href="#!">one</a></li>
                            <li><a href="#!">two</a></li>
                            <li class="divider"></li>
                            <li><a href="#!">three</a></li>
                        </ul>

                    </ul>
                    <ul class="right hide-on-med-and-up">
                        <li>
                            <img src="images/singers/empty_star.png" alt=""/>
                        </li>
                    </ul>
                    <ul id="slide-out" class="side-nav">
                        <li><p>МЕНЮ</p></li>
                        <li><a href="index.php">Башкы бет</a></li>
                        <li><a href="compare.php">Салыштыруу</a></li>
                        <li><a href="songs.php">Ырларым</a></li>
                        <li><a href="add_song.php">Ыр кошуу</a></li>
                        <!-- Dropdown Trigger -->
                        <li><a href="logout.php">Чыгуу</a></li>
                    </ul>
                    <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
                </div>

            </nav>
        </div>
    </div>
</div>
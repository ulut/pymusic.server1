<?php
include('config.php');
include('class/index_helper.php');
include('class/index_helper_yesterday.php');
//setlocale(LC_TIME, 'ru_RU.UTF-8', setlocale(LC_TIME, '0'));
setlocale(LC_TIME, 'ru_RU.utf8');
//setlocale(LC_ALL, 'ru_RU.UTF-8');
//var_dump(setlocale(LC_ALL, 'ru_RU.utf8'));
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <title>Тынчтыктын Мониторинг Сервиси</title>

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/font-awesome.css"  media="screen,projection"/>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>

<div class="header white z-depth-1">
    <div class="container">
        <div class="row">
            <nav>

                <div class="nav-wrapper">
                    <a href="#" class="brand-logo center">
                        <img src="images/logo_red_on_white.png" alt=""/>
                    </a>
                    <ul class="right">

                        <li class="logout">
                            <a href="artist/login.php"><span class="hide-on-med-and-down">Жылдыз ке?сеси</span><i class="mdi-action-exit-to-app right"></i></a>
                        </li>
                        <!-- Dropdown Trigger -->

                    </ul>
                </div>

            </nav>
        </div>
    </div>
</div>


<div class="content">

<!--    SONGS ROW-->

<div class="row">

<!--    songs yesterday row-->

<div class="col s12 m6 l3">
    <div class="card white z-depth-2 songs-list">
        <div class="card-content white-text">
            <h4 class="card-title center-align">
                Кечээ к?н?
            </h4>

            <div class="card-panel">

                <ul class="collection">

                    <?php
                    $counter=1;
                    $last_id = 0;
                    $last_week_leader_song = $yesterday_leader_song[0];
                    foreach($last_week_leader_song as $key=>$singer) {
                        if ($counter==6) {
                            $last_id = $key;
                            break;}
                        if ($key>0 && $last_week_leader_song[$key]['melody_id'] == $last_week_leader_song[$key-1]['melody_id']) continue;
                        $checker_key = $key+1;
                        $artist_name = $singer['artist_name'];
                        while($last_week_leader_song[$key]['melody_id'] == $last_week_leader_song[$checker_key]['melody_id']){
                            $artist_name .= ", ".$last_week_leader_song[$checker_key]['artist_name'];
                            $checker_key++;
                        }
                        ?>

                        <li class="collection-item">
                            <p class="place"><?php echo $singer['real_counter']; ?></p>
                            <?php if ($singer['movement']>15) { ?>
                                <span class="badge left movement move-higher">+<?php echo $singer['movement']; ?><i class="fa fa-rocket"></i></span>
                            <?php } else if ($singer['movement']==0.5) { ?>
                                <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                            <?php } else if ($singer['movement']>0) { ?>
                                <span class="badge left movement move-up">+<?php echo $singer['movement']; ?><i class="fa fa-arrow-up"></i></span>
                            <?php } else if ($singer['movement']<0) { ?>
                                <span class="badge left movement move-down"><?php echo $singer['movement']; ?><i class="fa fa-arrow-down"></i></span>
                            <?php } else { ?>
                                <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                            <?php } ?>
                            <h5 id="song<?php echo $singer['melody_id'];?>"><?php echo $singer['song'];?></h5>
                            <h6 class=""><?php echo $artist_name;?></h6>
                        </li>

                        <?php
                        $counter++; } ?>

                    <li class="collection-item with-collapsible">
                        <ul class="collapsible second-level" data-collapsible="accordion">
                            <li id="collapseSongList1">
                                <div class="collapsible-body">

                                    <ul class="collection">

                                        <?php
                                        $counter_collapsed=6;
                                        $last_week_leader_song_collapsed = $yesterday_leader_song[0];
                                        foreach($last_week_leader_song_collapsed as $key=>$singer_collapsed) {
                                            if ($key < $last_id) continue;
                                            if ($counter_collapsed == 51) break;
                                            if ($key>0 && $last_week_leader_song_collapsed[$key]['melody_id'] == $last_week_leader_song_collapsed[$key-1]['melody_id']) continue;
                                            $checker_key_collapsed = $key+1;
                                            $artist_name_collapsed = $singer_collapsed['artist_name'];
                                            while($last_week_leader_song_collapsed[$key]['melody_id'] == $last_week_leader_song_collapsed[$checker_key_collapsed]['melody_id']){
                                                $artist_name_collapsed .= ", ".$last_week_leader_song_collapsed[$checker_key_collapsed]['artist_name'];
                                                $checker_key_collapsed++;
                                            }
                                            ?>

                                            <li class="collection-item">
                                                <p class="place"><?php echo $singer_collapsed['real_counter']; ?></p>
                                                <?php if ($singer_collapsed['movement']>15) { ?>
                                                    <span class="badge left movement move-higher">+<?php echo $singer_collapsed['movement']; ?><i class="fa fa-rocket"></i></span>
                                                <?php } else if ($singer_collapsed['movement']==0.5) { ?>
                                                    <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                                                <?php } else if ($singer_collapsed['movement']>0) { ?>
                                                    <span class="badge left movement move-up">+<?php echo $singer_collapsed['movement']; ?><i class="fa fa-arrow-up"></i></span>
                                                <?php } else if ($singer_collapsed['movement']<0) { ?>
                                                    <span class="badge left movement move-down"><?php echo $singer_collapsed['movement']; ?><i class="fa fa-arrow-down"></i></span>
                                                <?php } else { ?>
                                                    <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                                                <?php } ?>
                                                <h5 id="song<?php echo $singer_collapsed['melody_id'];?>"><?php echo $singer_collapsed['song'];?></h5>
                                                <h6 class=""><?php echo $artist_name_collapsed;?></h6>
                                            </li>

                                            <?php
                                            $counter_collapsed++; } ?>

                                    </ul>

                                </div>
                                <div class="collapsible-header center">
                                    <button id="btnSongCollapse1" class="btn waves-effect waves-light red lighten-1" type="submit" name="action">
                                        Тизмени толук ач
                                    </button>
                                </div>

                            </li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>

    </div>


</div>



<!--    songs 1st week row-->

<div class="col s12 m6 l3">
    <div class="card white z-depth-2 songs-list">
        <div class="card-content white-text">
            <h4 class="card-title center-align">
                <?php echo date("d.m", $dateStart[0]); ?> - <?php echo date("d.m", $dateLast[0]); ?>
            </h4>

            <div class="card-panel">

                <ul class="collection">

                    <?php
                    $counter=1;
                    $last_id = 0;
                    $last_week_leader_song = $leader_song[0];
                    foreach($last_week_leader_song as $key=>$singer) {
                        if ($counter==6) {
                            $last_id = $key;
                            break;}
                        if ($key>0 && $last_week_leader_song[$key]['melody_id'] == $last_week_leader_song[$key-1]['melody_id']) continue;
                        $checker_key = $key+1;
                        $artist_name = $singer['artist_name'];
                        while($last_week_leader_song[$key]['melody_id'] == $last_week_leader_song[$checker_key]['melody_id']){
                            $artist_name .= ", ".$last_week_leader_song[$checker_key]['artist_name'];
                            $checker_key++;
                        }
                        ?>

                        <li class="collection-item">
                            <p class="place"><?php echo $singer['real_counter']; ?></p>
                            <?php if ($singer['movement']>15) { ?>
                                <span class="badge left movement move-higher">+<?php echo $singer['movement']; ?><i class="fa fa-rocket"></i></span>
                            <?php } else if ($singer['movement']==0.5) { ?>
                                <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                            <?php } else if ($singer['movement']>0) { ?>
                                <span class="badge left movement move-up">+<?php echo $singer['movement']; ?><i class="fa fa-arrow-up"></i></span>
                            <?php } else if ($singer['movement']<0) { ?>
                                <span class="badge left movement move-down"><?php echo $singer['movement']; ?><i class="fa fa-arrow-down"></i></span>
                            <?php } else { ?>
                                <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                            <?php } ?>
                            <h5 id="song<?php echo $singer['melody_id'];?>"><?php echo $singer['song'];?></h5>
                            <h6 class=""><?php echo $artist_name;?></h6>
                        </li>

                        <?php
                        $counter++; } ?>

                    <li class="collection-item with-collapsible">
                        <ul class="collapsible second-level" data-collapsible="accordion">
                            <li id="collapseSongList1">
                                <div class="collapsible-body">

                                    <ul class="collection">

                                        <?php
                                        $counter_collapsed=6;
                                        $last_week_leader_song_collapsed = $leader_song[0];
                                        foreach($last_week_leader_song_collapsed as $key=>$singer_collapsed) {
                                            if ($key < $last_id) continue;
                                            if ($counter_collapsed == 51) break;
                                            if ($key>0 && $last_week_leader_song_collapsed[$key]['melody_id'] == $last_week_leader_song_collapsed[$key-1]['melody_id']) continue;
                                            $checker_key_collapsed = $key+1;
                                            $artist_name_collapsed = $singer_collapsed['artist_name'];
                                            while($last_week_leader_song_collapsed[$key]['melody_id'] == $last_week_leader_song_collapsed[$checker_key_collapsed]['melody_id']){
                                                $artist_name_collapsed .= ", ".$last_week_leader_song_collapsed[$checker_key_collapsed]['artist_name'];
                                                $checker_key_collapsed++;
                                            }
                                            ?>

                                            <li class="collection-item">
                                                <p class="place"><?php echo $singer_collapsed['real_counter']; ?></p>
                                                <?php if ($singer_collapsed['movement']>15) { ?>
                                                    <span class="badge left movement move-higher">+<?php echo $singer_collapsed['movement']; ?><i class="fa fa-rocket"></i></span>
                                                <?php } else if ($singer_collapsed['movement']==0.5) { ?>
                                                    <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                                                <?php } else if ($singer_collapsed['movement']>0) { ?>
                                                    <span class="badge left movement move-up">+<?php echo $singer_collapsed['movement']; ?><i class="fa fa-arrow-up"></i></span>
                                                <?php } else if ($singer_collapsed['movement']<0) { ?>
                                                    <span class="badge left movement move-down"><?php echo $singer_collapsed['movement']; ?><i class="fa fa-arrow-down"></i></span>
                                                <?php } else { ?>
                                                    <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                                                <?php } ?>
                                                <h5 id="song<?php echo $singer_collapsed['melody_id'];?>"><?php echo $singer_collapsed['song'];?></h5>
                                                <h6 class=""><?php echo $artist_name_collapsed;?></h6>
                                            </li>

                                            <?php
                                            $counter_collapsed++; } ?>

                                    </ul>

                                </div>
                                <div class="collapsible-header center">
                                    <button id="btnSongCollapse1" class="btn waves-effect waves-light red lighten-1" type="submit" name="action">
                                        Тизмени толук ач
                                    </button>
                                </div>

                            </li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>

    </div>


</div>

<!--    songs 2nd week row-->

<div class="col s12 m6 l3">
    <div class="card white z-depth-2 songs-list">
        <div class="card-content white-text">
            <h4 class="card-title center-align">
                <?php echo date("d.m", $dateStart[1]); ?> - <?php echo date("d.m", $dateLast[1]); ?>
            </h4>

            <div class="card-panel">

                <ul class="collection">

                    <?php
                    $counter=1;
                    $last_id = 0;
                    $last_week_leader_song = $leader_song[1];
                    foreach($last_week_leader_song as $key=>$singer) {
                        if ($counter==6) {
                            $last_id = $key;
                            break;}
                        if ($key>0 && $last_week_leader_song[$key]['melody_id'] == $last_week_leader_song[$key-1]['melody_id']) continue;
                        $checker_key = $key+1;
                        $artist_name = $singer['artist_name'];
                        while($last_week_leader_song[$key]['melody_id'] == $last_week_leader_song[$checker_key]['melody_id']){
                            $artist_name .= ", ".$last_week_leader_song[$checker_key]['artist_name'];
                            $checker_key++;
                        }
                        ?>

                        <li class="collection-item">
                            <p class="place"><?php echo $singer['real_counter']; ?></p>
                            <?php if ($singer['movement']>15) { ?>
                                <span class="badge left movement move-higher">+<?php echo $singer['movement']; ?><i class="fa fa-rocket"></i></span>
                            <?php } else if ($singer['movement']==0.5) { ?>
                                <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                            <?php } else if ($singer['movement']>0) { ?>
                                <span class="badge left movement move-up">+<?php echo $singer['movement']; ?><i class="fa fa-arrow-up"></i></span>
                            <?php } else if ($singer['movement']<0) { ?>
                                <span class="badge left movement move-down"><?php echo $singer['movement']; ?><i class="fa fa-arrow-down"></i></span>
                            <?php } else { ?>
                                <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                            <?php } ?>
                            <h5 id="song<?php echo $singer['melody_id'];?>"><?php echo $singer['song'];?></h5>
                            <h6><?php echo $artist_name;?></h6>
                        </li>

                        <?php
                        $counter++; } ?>

                    <li class="collection-item with-collapsible">
                        <ul class="collapsible second-level" data-collapsible="accordion">
                            <li id="collapseSongList2">
                                <div class="collapsible-body">

                                    <ul class="collection">

                                        <?php
                                        $counter_collapsed=6;
                                        $last_week_leader_song_collapsed = $leader_song[1];
                                        foreach($last_week_leader_song_collapsed as $key=>$singer_collapsed) {
                                            if ($key < $last_id) continue;
                                            if ($counter_collapsed == 51) break;
                                            if ($key>0 && $last_week_leader_song_collapsed[$key]['melody_id'] == $last_week_leader_song_collapsed[$key-1]['melody_id']) continue;
                                            $checker_key_collapsed = $key+1;
                                            $artist_name_collapsed = $singer_collapsed['artist_name'];
                                            while($last_week_leader_song_collapsed[$key]['melody_id'] == $last_week_leader_song_collapsed[$checker_key_collapsed]['melody_id']){
                                                $artist_name_collapsed .= ", ".$last_week_leader_song_collapsed[$checker_key_collapsed]['artist_name'];
                                                $checker_key_collapsed++;
                                            }
                                            ?>

                                            <li class="collection-item">
                                                <p class="place"><?php echo $singer_collapsed['real_counter']; ?></p>
                                                <?php if ($singer_collapsed['movement']>15) { ?>
                                                    <span class="badge left movement move-higher">+<?php echo $singer_collapsed['movement']; ?><i class="fa fa-rocket"></i></span>
                                                <?php } else if ($singer_collapsed['movement']==0.5) { ?>
                                                    <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                                                <?php } else if ($singer_collapsed['movement']>0) { ?>
                                                    <span class="badge left movement move-up">+<?php echo $singer_collapsed['movement']; ?><i class="fa fa-arrow-up"></i></span>
                                                <?php } else if ($singer_collapsed['movement']<0) { ?>
                                                    <span class="badge left movement move-down"><?php echo $singer_collapsed['movement']; ?><i class="fa fa-arrow-down"></i></span>
                                                <?php } else { ?>
                                                    <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                                                <?php } ?>
                                                <h5 id="song<?php echo $singer_collapsed['melody_id'];?>"><?php echo $singer_collapsed['song'];?></h5>
                                                <h6><?php echo $artist_name_collapsed;?></h6>
                                            </li>

                                            <?php
                                            $counter_collapsed++; } ?>

                                    </ul>

                                </div>
                                <div class="collapsible-header center">
                                    <button id="btnSongCollapse2" class="btn waves-effect waves-light red lighten-1" type="submit" name="action">
                                        Тизмени толук ач
                                    </button>
                                </div>

                            </li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>

    </div>


</div>

<!--    songs 3rd week row-->

<div class="col s12 m6 l3">
    <div class="card white z-depth-2 songs-list">
        <div class="card-content white-text">
            <h4 class="card-title center-align">
                <?php echo date("d.m", $dateStart[2]); ?> - <?php echo date("d.m", $dateLast[2]); ?>
            </h4>

            <div class="card-panel">

                <ul class="collection">

                    <?php
                    $counter=1;
                    $last_id = 0;
                    $last_week_leader_song = $leader_song[2];
                    foreach($last_week_leader_song as $key=>$singer) {
                        if ($counter==6) {
                            $last_id = $key;
                            break;}
                        if ($key>0 && $last_week_leader_song[$key]['melody_id'] == $last_week_leader_song[$key-1]['melody_id']) continue;
                        $checker_key = $key+1;
                        $artist_name = $singer['artist_name'];
                        while($last_week_leader_song[$key]['melody_id'] == $last_week_leader_song[$checker_key]['melody_id']){
                            $artist_name .= ", ".$last_week_leader_song[$checker_key]['artist_name'];
                            $checker_key++;
                        }
                        ?>

                        <li class="collection-item">
                            <p class="place"><?php echo $singer['real_counter']; ?></p>
                            <?php if ($singer['movement']>15) { ?>
                                <span class="badge left movement move-higher">+<?php echo $singer['movement']; ?><i class="fa fa-rocket"></i></span>
                            <?php } else if ($singer['movement']==0.5) { ?>
                                <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                            <?php } else if ($singer['movement']>0) { ?>
                                <span class="badge left movement move-up">+<?php echo $singer['movement']; ?><i class="fa fa-arrow-up"></i></span>
                            <?php } else if ($singer['movement']<0) { ?>
                                <span class="badge left movement move-down"><?php echo $singer['movement']; ?><i class="fa fa-arrow-down"></i></span>
                            <?php } else { ?>
                                <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                            <?php } ?>
                            <h5 id="song<?php echo $singer['melody_id'];?>"><?php echo $singer['song'];?></h5>
                            <h6><?php echo $artist_name;?></h6>
                        </li>

                        <?php
                        $counter++; } ?>

                    <li class="collection-item with-collapsible">
                        <ul class="collapsible second-level" data-collapsible="accordion">
                            <li id="collapseSongList3">
                                <div class="collapsible-body">

                                    <ul class="collection">

                                        <?php
                                        $counter_collapsed=6;
                                        $last_week_leader_song_collapsed = $leader_song[2];
                                        foreach($last_week_leader_song_collapsed as $key=>$singer_collapsed) {
                                            if ($key < $last_id) continue;
                                            if ($counter_collapsed == 51) break;
                                            if ($key>0 && $last_week_leader_song_collapsed[$key]['melody_id'] == $last_week_leader_song_collapsed[$key-1]['melody_id']) continue;
                                            $checker_key_collapsed = $key+1;
                                            $artist_name_collapsed = $singer_collapsed['artist_name'];
                                            while($last_week_leader_song_collapsed[$key]['melody_id'] == $last_week_leader_song_collapsed[$checker_key_collapsed]['melody_id']){
                                                $artist_name_collapsed .= ", ".$last_week_leader_song_collapsed[$checker_key_collapsed]['artist_name'];
                                                $checker_key_collapsed++;
                                            }
                                            ?>

                                            <li class="collection-item">
                                                <p class="place"><?php echo $singer_collapsed['real_counter']; ?></p>
                                                <?php if ($singer_collapsed['movement']>15) { ?>
                                                    <span class="badge left movement move-higher">+<?php echo $singer_collapsed['movement']; ?><i class="fa fa-rocket"></i></span>
                                                <?php } else if ($singer_collapsed['movement']==0.5) { ?>
                                                    <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                                                <?php } else if ($singer_collapsed['movement']>0) { ?>
                                                    <span class="badge left movement move-up">+<?php echo $singer_collapsed['movement']; ?><i class="fa fa-arrow-up"></i></span>
                                                <?php } else if ($singer_collapsed['movement']<0) { ?>
                                                    <span class="badge left movement move-down"><?php echo $singer_collapsed['movement']; ?><i class="fa fa-arrow-down"></i></span>
                                                <?php } else { ?>
                                                    <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                                                <?php } ?>
                                                <h5 id="song<?php echo $singer_collapsed['melody_id'];?>"><?php echo $singer_collapsed['song'];?></h5>
                                                <h6><?php echo $artist_name_collapsed;?></h6>
                                            </li>

                                            <?php
                                            $counter_collapsed++; } ?>

                                    </ul>

                                </div>
                                <div class="collapsible-header center">
                                    <button id="btnSongCollapse3" class="btn waves-effect waves-light red lighten-1" type="submit" name="action">
                                        Тизмени толук ач
                                    </button>
                                </div>

                            </li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>

    </div>

</div>


</div>

<!--    SINGERS ROW-->

<div class="row">

<!--    singers yesterday row-->

<div class="col s12 m6 l3">
    <div class="card white z-depth-2 songs-list singers-list">
        <div class="card-content white-text">
            <h4 class="card-title center-align">
                Кечээ к?н?
            </h4>


            <div class="card-panel">

                <ul class="collection">

                    <?php
                    $counter=1;
                    $this_week_leader_singer = $yesterday_leader_singer[0];
                    foreach($this_week_leader_singer as $key=>$singer) {
                        if ($counter==6) {
                            break;}
                        ?>

                        <li class="collection-item">
                            <p class="place"><?php echo $singer['real_counter']; ?></p>
                            <?php if ($singer['movement']>15) { ?>
                                <span class="badge left movement move-higher">+<?php echo $singer['movement']; ?><i class="fa fa-rocket"></i></span>
                            <?php } else if ($singer['movement']==0.5) { ?>
                                <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                            <?php } else if ($singer['movement']>0) { ?>
                                <span class="badge left movement move-up">+<?php echo $singer['movement']; ?><i class="fa fa-arrow-up"></i></span>
                            <?php } else if ($singer['movement']<0) { ?>
                                <span class="badge left movement move-down"><?php echo $singer['movement']; ?><i class="fa fa-arrow-down"></i></span>
                            <?php } else { ?>
                                <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                            <?php } ?>
                            <h5 id="singer<?php echo $singer['artist_id'];?>"><?php echo $singer['artist'];?></h5>
                        </li>

                        <?php
                        $counter++; } ?>

                    <li class="collection-item with-collapsible">
                        <ul class="collapsible second-level" data-collapsible="accordion">
                            <li id="collapseSingerList1">
                                <div class="collapsible-body">

                                    <ul class="collection">

                                        <?php
                                        $counter_collapsed=5;
                                        $this_week_leader_singer_collapsed = $yesterday_leader_singer[0];
                                        foreach($this_week_leader_singer_collapsed as $key=>$singer_collapsed) {
                                            if ($key < 5) continue;
                                            if ($counter_collapsed == 50) break;
                                            ?>

                                            <li class="collection-item">
                                                <p class="place"><?php echo $singer_collapsed['real_counter']; ?></p>
                                                <?php if ($singer_collapsed['movement']>15) { ?>
                                                    <span class="badge left movement move-higher">+<?php echo $singer_collapsed['movement']; ?><i class="fa fa-rocket"></i></span>
                                                <?php } else if ($singer_collapsed['movement']==0.5) { ?>
                                                    <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                                                <?php } else if ($singer_collapsed['movement']>0) { ?>
                                                    <span class="badge left movement move-up">+<?php echo $singer_collapsed['movement']; ?><i class="fa fa-arrow-up"></i></span>
                                                <?php } else if ($singer_collapsed['movement']<0) { ?>
                                                    <span class="badge left movement move-down"><?php echo $singer_collapsed['movement']; ?><i class="fa fa-arrow-down"></i></span>
                                                <?php } else { ?>
                                                    <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                                                <?php } ?>
                                                <h5 id="singer<?php echo $singer_collapsed['artist_id'];?>"><?php echo $singer_collapsed['artist'];?></h5>
                                            </li>

                                            <?php
                                            $counter_collapsed++; } ?>
                                    </ul>

                                </div>
                                <div class="collapsible-header center">
                                    <button id="btnSingerCollapse1" class="btn waves-effect waves-light grey" type="submit" name="action">
                                        Тизмени толук ач
                                    </button>
                                </div>

                            </li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>

    </div>


</div>

<!--    singers 1st week row-->

<div class="col s12 m6 l3">
    <div class="card white z-depth-2 songs-list singers-list">
        <div class="card-content white-text">
            <h4 class="card-title center-align">
                <?php echo date("d.m", $dateStart[0]); ?> - <?php echo date("d.m", $dateLast[0]); ?>
            </h4>

            <div class="card-panel">

                <ul class="collection">

                    <?php
                    $counter=1;
                    $this_week_leader_singer = $leader_singer[0];
                    foreach($this_week_leader_singer as $key=>$singer) {
                        if ($counter==6) {
                            break;}
                        ?>

                        <li class="collection-item">
                            <p class="place"><?php echo $singer['real_counter']; ?></p>
                            <?php if ($singer['movement']>15) { ?>
                                <span class="badge left movement move-higher">+<?php echo $singer['movement']; ?><i class="fa fa-rocket"></i></span>
                            <?php } else if ($singer['movement']==0.5) { ?>
                                <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                            <?php } else if ($singer['movement']>0) { ?>
                                <span class="badge left movement move-up">+<?php echo $singer['movement']; ?><i class="fa fa-arrow-up"></i></span>
                            <?php } else if ($singer['movement']<0) { ?>
                                <span class="badge left movement move-down"><?php echo $singer['movement']; ?><i class="fa fa-arrow-down"></i></span>
                            <?php } else { ?>
                                <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                            <?php } ?>
                            <h5 id="singer<?php echo $singer['artist_id'];?>"><?php echo $singer['artist'];?></h5>
                        </li>

                        <?php
                        $counter++; } ?>

                    <li class="collection-item with-collapsible">
                        <ul class="collapsible second-level" data-collapsible="accordion">
                            <li id="collapseSingerList1">
                                <div class="collapsible-body">

                                    <ul class="collection">

                                        <?php
                                        $counter_collapsed=5;
                                        $this_week_leader_singer_collapsed = $leader_singer[0];
                                        foreach($this_week_leader_singer_collapsed as $key=>$singer_collapsed) {
                                            if ($key < 5) continue;
                                            if ($counter_collapsed == 51) break;
                                            ?>

                                            <li class="collection-item">
                                                <p class="place"><?php echo $singer_collapsed['real_counter']; ?></p>
                                                <?php if ($singer_collapsed['movement']>15) { ?>
                                                    <span class="badge left movement move-higher">+<?php echo $singer_collapsed['movement']; ?><i class="fa fa-rocket"></i></span>
                                                <?php } else if ($singer_collapsed['movement']==0.5) { ?>
                                                    <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                                                <?php } else if ($singer_collapsed['movement']>0) { ?>
                                                    <span class="badge left movement move-up">+<?php echo $singer_collapsed['movement']; ?><i class="fa fa-arrow-up"></i></span>
                                                <?php } else if ($singer_collapsed['movement']<0) { ?>
                                                    <span class="badge left movement move-down"><?php echo $singer_collapsed['movement']; ?><i class="fa fa-arrow-down"></i></span>
                                                <?php } else { ?>
                                                    <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                                                <?php } ?>
                                                <h5 id="singer<?php echo $singer_collapsed['artist_id'];?>"><?php echo $singer_collapsed['artist'];?></h5>
                                            </li>

                                            <?php
                                            $counter_collapsed++; } ?>
                                    </ul>

                                </div>
                                <div class="collapsible-header center">
                                    <button id="btnSingerCollapse1" class="btn waves-effect waves-light grey" type="submit" name="action">
                                        Тизмени толук ач
                                    </button>
                                </div>

                            </li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>

    </div>


</div>

<!--    singers 2nd week row-->

<div class="col s12 m6 l3">
    <div class="card white z-depth-2 songs-list singers-list">
        <div class="card-content white-text">
            <h4 class="card-title center-align">
                <?php echo date("d.m", $dateStart[1]); ?> - <?php echo date("d.m", $dateLast[1]); ?>
            </h4>

            <div class="card-panel">

                <ul class="collection">

                    <?php
                    $counter=1;
                    $this_week_leader_singer = $leader_singer[1];
                    foreach($this_week_leader_singer as $key=>$singer) {
                        if ($counter==6) {
                            break;}
                        ?>

                        <li class="collection-item">
                            <p class="place"><?php echo $singer['real_counter']; ?></p>
                            <?php if ($singer['movement']>15) { ?>
                                <span class="badge left movement move-higher">+<?php echo $singer['movement']; ?><i class="fa fa-rocket"></i></span>
                            <?php } else if ($singer['movement']==0.5) { ?>
                                <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                            <?php } else if ($singer['movement']>0) { ?>
                                <span class="badge left movement move-up">+<?php echo $singer['movement']; ?><i class="fa fa-arrow-up"></i></span>
                            <?php } else if ($singer['movement']<0) { ?>
                                <span class="badge left movement move-down"><?php echo $singer['movement']; ?><i class="fa fa-arrow-down"></i></span>
                            <?php } else { ?>
                                <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                            <?php } ?>
                            <h5 id="singer<?php echo $singer['artist_id'];?>"><?php echo $singer['artist'];?></h5>
                        </li>

                        <?php
                        $counter++; } ?>

                    <li class="collection-item with-collapsible">
                        <ul class="collapsible second-level" data-collapsible="accordion">
                            <li id="collapseSingerList2">
                                <div class="collapsible-body">

                                    <ul class="collection">

                                        <?php
                                        $counter_collapsed=5;
                                        $this_week_leader_singer_collapsed = $leader_singer[1];
                                        foreach($this_week_leader_singer_collapsed as $key=>$singer_collapsed) {
                                            if ($key < 5) continue;
                                            if ($counter_collapsed == 51) break;
                                            ?>

                                            <li class="collection-item">
                                                <p class="place"><?php echo $singer_collapsed['real_counter']; ?></p>
                                                <?php if ($singer_collapsed['movement']>15) { ?>
                                                    <span class="badge left movement move-higher">+<?php echo $singer_collapsed['movement']; ?><i class="fa fa-rocket"></i></span>
                                                <?php } else if ($singer_collapsed['movement']==0.5) { ?>
                                                    <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                                                <?php } else if ($singer_collapsed['movement']>0) { ?>
                                                    <span class="badge left movement move-up">+<?php echo $singer_collapsed['movement']; ?><i class="fa fa-arrow-up"></i></span>
                                                <?php } else if ($singer_collapsed['movement']<0) { ?>
                                                    <span class="badge left movement move-down"><?php echo $singer_collapsed['movement']; ?><i class="fa fa-arrow-down"></i></span>
                                                <?php } else { ?>
                                                    <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                                                <?php } ?>
                                                <h5 id="singer<?php echo $singer_collapsed['artist_id'];?>"><?php echo $singer_collapsed['artist'];?></h5>
                                            </li>

                                            <?php
                                            $counter_collapsed++; } ?>
                                    </ul>

                                </div>
                                <div class="collapsible-header center">
                                    <button id="btnSingerCollapse2" class="btn waves-effect waves-light grey" type="submit" name="action">
                                        Тизмени толук ач
                                    </button>
                                </div>

                            </li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>

    </div>

</div>

<!--    singers 3rd week row-->

<div class="col s12 m6 l3">
    <div class="card white z-depth-2 songs-list singers-list">
        <div class="card-content white-text">
            <h4 class="card-title center-align">
                <?php echo date("d.m", $dateStart[2]); ?> - <?php echo date("d.m", $dateLast[2]); ?>
            </h4>

            <div class="card-panel">

                <ul class="collection">

                    <?php
                    $counter=1;
                    $this_week_leader_singer = $leader_singer[2];
                    foreach($this_week_leader_singer as $key=>$singer) {
                        if ($counter==6) {
                            break;}
                        ?>

                        <li class="collection-item">
                            <p class="place"><?php echo $singer['real_counter']; ?></p>
                            <?php if ($singer['movement']>15) { ?>
                                <span class="badge left movement move-higher">+<?php echo $singer['movement']; ?><i class="fa fa-rocket"></i></span>
                            <?php } else if ($singer['movement']==0.5) { ?>
                                <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                            <?php } else if ($singer['movement']>0) { ?>
                                <span class="badge left movement move-up">+<?php echo $singer['movement']; ?><i class="fa fa-arrow-up"></i></span>
                            <?php } else if ($singer['movement']<0) { ?>
                                <span class="badge left movement move-down"><?php echo $singer['movement']; ?><i class="fa fa-arrow-down"></i></span>
                            <?php } else { ?>
                                <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                            <?php } ?>
                            <h5 id="singer<?php echo $singer['artist_id'];?>"><?php echo $singer['artist'];?></h5>
                        </li>

                        <?php
                        $counter++; } ?>

                    <li class="collection-item with-collapsible">
                        <ul class="collapsible second-level" data-collapsible="accordion">
                            <li id="collapseSingerList3">
                                <div class="collapsible-body">

                                    <ul class="collection">

                                        <?php
                                        $counter_collapsed=5;
                                        $this_week_leader_singer_collapsed = $leader_singer[2];
                                        foreach($this_week_leader_singer_collapsed as $key=>$singer_collapsed) {
                                            if ($key < 5) continue;
                                            if ($counter_collapsed == 51) break;
                                            ?>

                                            <li class="collection-item">
                                                <p class="place"><?php echo $singer_collapsed['real_counter']; ?></p>
                                                <?php if ($singer_collapsed['movement']>15) { ?>
                                                    <span class="badge left movement move-higher">+<?php echo $singer_collapsed['movement']; ?><i class="fa fa-rocket"></i></span>
                                                <?php } else if ($singer_collapsed['movement']==0.5) { ?>
                                                    <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                                                <?php } else if ($singer_collapsed['movement']>0) { ?>
                                                    <span class="badge left movement move-up">+<?php echo $singer_collapsed['movement']; ?><i class="fa fa-arrow-up"></i></span>
                                                <?php } else if ($singer_collapsed['movement']<0) { ?>
                                                    <span class="badge left movement move-down"><?php echo $singer_collapsed['movement']; ?><i class="fa fa-arrow-down"></i></span>
                                                <?php } else { ?>
                                                    <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                                                <?php } ?>
                                                <h5 id="singer<?php echo $singer_collapsed['artist_id'];?>"><?php echo $singer_collapsed['artist'];?></h5>
                                            </li>

                                            <?php
                                            $counter_collapsed++; } ?>
                                    </ul>

                                </div>
                                <div class="collapsible-header center">
                                    <button id="btnSingerCollapse3" class="btn waves-effect waves-light grey" type="submit" name="action">
                                        Тизмени толук ач
                                    </button>
                                </div>

                            </li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>

    </div>


</div>

<!--    singers 4th week row-->



</div>

</div>

<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/materialize.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

        $("h5").click(function() {
            $('h5').parent().css('background', 'transparent');
            var clickedBtnID = $(this).attr('id');
            //var newColor = '#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6);
            $('[id="'+clickedBtnID+'"]').parent().css("background-color","#acece6");
        });

        $('#btnSongCollapse1').click(function(){
            changeButtonText('#btnSongCollapse1', '#collapseSongList1');
        });
        $('#btnSingerCollapse1').click(function(){
            changeButtonText('#btnSingerCollapse1', '#collapseSingerList1');
        });

        $('#btnSongCollapse2').click(function(){
            changeButtonText('#btnSongCollapse2', '#collapseSongList2');
        });
        $('#btnSingerCollapse2').click(function(){
            changeButtonText('#btnSingerCollapse2', '#collapseSingerList2');
        });

        $('#btnSongCollapse3').click(function(){
            changeButtonText('#btnSongCollapse3', '#collapseSongList3');
        });
        $('#btnSingerCollapse3').click(function(){
            changeButtonText('#btnSingerCollapse3', '#collapseSingerList3');
        });

        $('#btnSongCollapse4').click(function(){
            changeButtonText('#btnSongCollapse4', '#collapseSongList4');
        });
        $('#btnSingerCollapse4').click(function(){
            changeButtonText('#btnSingerCollapse4', '#collapseSingerList4');
        });


        function changeButtonText(button, box){
            if ($(box).hasClass('active')){
                $(button).text('Тизмени толук ач');
                $('html,body').animate({scrollTop: $(box).offset().top-400},'slow');
            }else {
                $(button).text('Тизмени жап');
                $('html,body').animate({scrollTop: $(box).offset().top-400},'slow');
            }
        }
    });
</script>

<?php include("ga.php") ?>

</body>
</html>
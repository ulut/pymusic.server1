<?php
include('config.php');
include('class/lady_helper.php');
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
                            <a href="artist/login.php"><span class="hide-on-med-and-down">Жылдыз кеңсеси</span><i class="mdi-action-exit-to-app right"></i></a>
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

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LADY.KG эксклюзив
</div>
<div class="row">
<div class="col s12 m6 l3">
    <div class="card white z-depth-2 songs-list">
        <div class="card-content white-text">
            <h4 class="card-title center-align">
                <?php echo date("d.m.Y", $dateStart[0]); ?> - <?php echo date("d.m.Y", $dateLast[0]); ?>
            </h4>

            <div class="card-panel">

                <ul class="collection">

                    <?php
                    $counter=1;
                    $last_id = 0;
                    $last_week_leader_song = $leader_song[0];
                    foreach($last_week_leader_song as $key=>$singer) {
                        if ($counter==11) {
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
                <?php echo date("d.m.Y", $dateStart[0]); ?> - <?php echo date("d.m.Y", $dateLast[0]); ?>
            </h4>

            <div class="card-panel">

                <ul class="collection">

                    <?php
                    $counter=1;
                    $this_week_leader_singer = $leader_singer[0];
                    foreach($this_week_leader_singer as $key=>$singer) {
                        if ($counter==11) {
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

                    
                </ul>

            </div>

        </div>

    </div>








<!--    singers 4th week row-->



</div>
<div class="col s12 m6 l3">
    <div class="card white z-depth-2 songs-list singers-list">
	<div class="card-content white-text">
            <h4 class="card-title center-align">
                Кыскача түшүндүрмөлөр
            </h4>
        <div class="card-panel">
			<ul class="collection">
			
			<li class="collection-item"><h5>Аркы жумага салыштырмалуу өзгөрүү:</li>
			<li class="collection-item"><hr/></li>
			
			<li class="collection-item"><h5>Тизмеге жаңыдан же кайрадан кирди <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span></li>
			<li class="collection-item"><hr/></li>
			<li class="collection-item"><h5>Жогору карай көтөрүлдү <span class="badge left movement move-up">+<i class="fa fa-arrow-up"></i></span></li>
			<li class="collection-item"><hr/></li>
			<li class="collection-item"><h5>Ракета, жогору карай көп баскычка көтөрүлдү<span class="badge left movement move-higher">+<i class="fa fa-rocket"></i></span></li>
			<li class="collection-item"><hr/></li>
			<li class="collection-item"><h5>Төмөндөдү<span class="badge left movement move-down">-<i class="fa fa-arrow-down"></i></span></li>
			<li class="collection-item"><hr/></li>
			<li class="collection-item"><h5>Өткөн жумадагы ордун сактап калды<span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span></li>
			</ul>
	</div>


</div>
</div>
</div>
</div>
</div>
<?php include("ga.php") ?>

</body>
</html>
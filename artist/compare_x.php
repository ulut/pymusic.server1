<?php
include('main_header.php');
include('header.php');
if (isset($_POST['mysinger'])){
    $singer1 = getpost('mysinger');
    $singer2 = getpost('vs');
    $radio_days = strtotime('-7 days');

    $query = "select pm.radio_id, count(pm.track_id) as total, a.name as artist, a.id as artist_id
			from played_melody pm, artist a,artist_melody am,melody m
			where a.id = am.artist_id
			and am.melody_id = m.id
			and pm.date_played >= '".date("Y-m-d",$radio_days)."'
			and m.track_id=pm.track_id
			AND( a.id = '".$singer1."' OR a.id = '".$singer2."')
			GROUP BY pm.radio_id, artist_id
			ORDER BY pm.radio_id";
    $compare_result = $db->selectpuresql($query);
    $first_name_ar= $db->selectpuresql("select name from artist where id=".$singer1);
    $second_name_ar= $db->selectpuresql("select name from artist where id=".$singer2);
    $first_name = $first_name_ar[0]['name'];
    $second_name = $second_name_ar[0]['name'];
}
?>

    <div class="content container">
        <div class="row">

            <div class="col s12 m12 l10 offset-l1">
                <div class="card white z-depth-2 stats">
                    <div class="card-content no-padding">
                        <h4 class="card-title center">
                            Салыштыруу
                        </h4>

                        <div class="row">
                            <form method="post" class="col s12 l10 offset-l1 song-form">
                                <div class="row">
                                    <div class="input-field center col s12 m6 l6">
                                        <?php
                                        if (count($_SESSION['singer_list'])==1) {
                                            $singer_list = $_SESSION['singer_list'];
                                            ?>

                                            <input type="hidden" name="singer" value="<?php echo $singer_list[0]['name'];?>" />
                                            <?php echo $singer_list[0]['name'];?>
                                        <?php } else if (count($_SESSION['singer_list'])>1) {?>

                                            <select name="mysinger">
                                                <option value="" disabled selected hidden>Ырчы тандыңыз</option>

                                                <?php foreach($_SESSION['singer_list'] as $singer){ ?>

                                                    <option value="<?php echo $singer['id'];?>"><?php echo $singer['name'];?></option>
                                                <?php } ?>
                                            </select>
                                        <?php } ?>
                                        <label>Ырчы</label>
                                    </div>
                                    <div class="input-field center col s12 m6 l6">
                                        <select name="vs">
                                            <option value="" disabled selected hidden>Ырчы тандыңыз</option>
                                            <?php
                                            $artist_list = $db->select("artist", "", "*", "order by name");
                                            foreach($artist_list as $singer) {
                                                ?>
                                                <option value="<?php echo $singer['id'];?>"><?php echo $singer['name'];?></option>
                                            <?php } ?>
                                        </select>
                                        <label>Ырчы</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field center">
                                        <button class="btn waves-effect waves-light" type="submit" name="action">Салыштыр
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (isset($singer1)) { ?>

                <div class="col s12 m12 l10 offset-l1">
                    <div class="card white z-depth-2 compare radios">
                        <div class="card-content no-padding ">
                            <h4 class="card-title center-align">
                                <span class="col l5 m5 s5"><?php echo $first_name;?></span>
                            <span class="col l2 m2 s2 vert-divider center">
                                <i class="mdi-action-star-rate"></i>
                            </span>
                                <span class="col l5 m5 s5"><?php echo $second_name;?></span>

                                <div class="clearfix"></div>
                            </h4>
                            <div class="card-panel col l8 offset-l2 m10 offset-m1 s10 offset-s1 clearfix">

                                <?php
                                $total1 = 0;
                                $total2 = 0;
                                $radios = $db->select("radio");
                                foreach($radios as $radio) {
                                    $singer1_total=0;
                                    $singer2_total=0;
                                    foreach($compare_result as $compare){
                                        if ($compare['radio_id']==$radio['id']){
                                            if ($compare['artist_id']==$singer1) $singer1_total = $compare['total'];
                                            if ($compare['artist_id']==$singer2) $singer2_total = $compare['total'];
                                        }
                                        if ($singer1_total>0 && $singer2_total>0) break;
                                    }

                                    $total1 += $singer1_total;
                                    $total2 += $singer2_total;
                                    if ($singer1_total+$singer2_total > 0) {
                                        $singer1_percent = round(100 * $singer1_total / ($singer1_total+$singer2_total));
                                        $singer2_percent = round(100 * $singer2_total / ($singer1_total+$singer2_total));
                                    } else $singer1_percent = $singer2_percent = 0;
                                    ?>

                                    <div class="row center">

                                        <div class="progress-outer-left">
                                            <div class="progress-wrap1 progress-wrap1<?php echo $radio['id'];?> progress1 progress-<?php echo $singer2_total>$singer1_total?"lost":"win";?>" data-progress-percent="<?php echo $singer1_percent;?>">
                                                <div class="progress-bar1 progress-bar1<?php echo $radio['id'];?> progress1"></div>
                                            </div>
                                        </div>

                                        <div class="progress progress-left progress-<?php echo $singer2_total>$singer1_total?"lost":"win";?>">
                                            <div class="determinate" style="width: <?php echo $singer1_percent;?>%">
                                                <div class="pin">
                                                    <span class=""><?php echo $singer1_percent;?>%</span>
                                                </div>
                                            </div>
                                        </div>

                                        <?php //if ($radio['logo']) {
                                        if (1) {
                                            ?>
                                            <a class="waves-effect waves-light btn btn-large btn-floating">
                                                <img src="images/radios/<?php echo $radio['logo'];?>" alt=""/>
                                            </a>
                                        <?php } else {
                                            $rid = $radio['id']; ?>
                                            <div>
                                                <?php
                                                echo $radio_names[$rid];
                                                ?>
                                            </div>
                                        <?php }
                                        ?>

                                        <div class="progress-outer-right">
                                            <div class="progress-wrap2 progress-wrap2<?php echo $radio['id'];?> progress1 progress-<?php echo $singer2_total<$singer1_total?"lost":"win";?>" data-progress-percent="<?php echo $singer2_percent;?>">
                                                <div class="progress-bar2 progress-bar2<?php echo $radio['id'];?> progress1"></div>
                                            </div>
                                        </div>

                                        <div class="progress progress-right progress-<?php echo $singer2_total<$singer1_total?"lost":"win";?>">
                                            <div class="determinate" style="width: <?php echo $singer2_percent;?>%">
                                                <div class="pin">
                                                    <span class=""><?php echo $singer2_percent;?>%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="row divider-row">
                                    <div class="divider"></div>
                                </div>
                                <?php
                                if ($total1+$total2 > 0) {
                                    $singer1_percent = round(100 * $total1 / ($total1+$total2));
                                    $singer2_percent = round(100 * $total2 / ($total1+$total2));
                                } else {
                                    $singer1_percent = $singer2_percent = 0;
                                }
                                ?>

                                <div class="row center total">
                                    <h6 class="total-left teal-text"><?php echo $singer1_percent;?>%</h6>

                                    <?php if ($total1>$total2) { ?>

                                        <a class="waves-effect waves-light btn btn-large btn-floating teal btn-left">
                                            <i class="mdi-action-thumb-up"></i>
                                        </a>

                                    <?php } else if ($total1<$total2) { ?>

                                        <a class="waves-effect waves-light btn btn-large btn-floating custom-red btn-right">
                                            <i class="mdi-action-thumb-down"></i>
                                        </a>

                                    <?php } else { ?>

                                        <a class="waves-effect waves-light btn btn-large btn-floating red lighten-2">
                                            <i class="mdi-action-accessibility"></i>
                                        </a>

                                    <?php } ?>


                                    <h6 class="total-right custom-red-text"><?php echo $singer2_percent;?>%</h6>
                                </div>

                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>

<?php include('footer_x.php'); ?>
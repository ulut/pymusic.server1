<?php
include('main_header.php');
include('header.php');
?>

    <div class="content container">
        <div class="row">

            <div class="col s12 m12 l12">
                <div class="card white z-depth-2 stats">
                    <div class="card-content no-padding">
                        <h4 class="card-title center">
                            Статистика
                        </h4>

                        <div class="row">
                            <form name="singer_stat" class="col s12 l10 offset-l1 song-form">
                                <div class="input-field center col s12 m6 l6">
                                    <select name="singer">
                                        <?php foreach($_SESSION['singer_list'] as $singer){ ?>
                                            <option value="<?php echo $singer['id'];?>"><?php echo $singer['name'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="input-field center col s12 m6 l6">
                                    <select name="radio">
                                        <option value="0" selected>Бүт радиолор</option>
                                        <?php foreach($radio_names as $key=>$value){ ?>
                                            <option value="<?php echo $key;?>"><?php echo $value;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="input-field col s12 m6 l3 offset-l3 from-date">
                                    <input name="from" placeholder="" type="text" class="datepicker prefix-after">
                                    <i class="mdi-action-today prefix center"></i>
                                </div>
                                <div class="input-field col s12 m6 l3 to-date">
                                    <input name="until" placeholder="" type="text" class="datepicker prefix-after">
                                    <i class="mdi-action-today prefix center"></i>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12 m12 l12 center">
                                        <button class="btn waves-effect waves-light" type="submit" name="action">Изде
                                        </button>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $today_radios_sql = "select pm.*, m.song from played_melody pm
								  inner join melody m on m.track_id=pm.track_id
								  inner join artist_melody am ON m.id = am.melody_id
								  inner join artist a ON a.id = am.artist_id
								  where pm.date_played >= CURDATE()
								  AND a.id in (".$_SESSION['singer_ids'].")
								  ORDER BY pm.radio_id, pm.time_played desc";
            //echo $today_radios_sql;
            $radio_result_raw = $db->selectpuresql($today_radios_sql);
            $radio_result = array();
            foreach($radio_result_raw as $item){
                $radio_id = $item['radio_id'];
                $radio_result[$radio_id][] = $item;
            }
            ?>

            <div class="col s12 m12 l6 offset-l3">
                <div class="card white z-depth-2 radios">
                    <div class="card-content white-text">
                        <h4 class="card-title center-align">Бүгүн</h4>

                        <div class="card-panel">

                            <ul class="collapsible" data-collapsible="accordion">
                                <?php if (count($radio_result_raw)) {
                                    foreach($radio_result as $radio) {
                                        $radio_id = $radio[0]["radio_id"];
                                        ?>
                                        <li>
                                            <div class="collapsible-header"><?php echo $radio_names[$radio_id];?></div>
                                            <div class="collapsible-body">

                                                <ul class="collection">
                                                    <li class="collection-item">
                                                        <ul class="collapsible second-level" data-collapsible="accordion">
                                                            <?php foreach ($radio as $radio_item) { ?>
                                                                <li>
                                                                    <div class="collapsible-header"><?php echo $radio_item['song']; ?></div>


                                                                    <ul class="collection">
                                                                        <li class="collection-item">
                                                                            <p><i class="mdi-action-today"></i><?php echo $radio_item['date_played']; ?> <span><i class="mdi-action-schedule"></i><?php echo $radio_item['time_played']; ?></span></p>
                                                                        </li>
                                                                    </ul>


                                                                </li>
                                                            <?php } ?>

                                                        </ul>
                                                    </li>
                                                    <li class="collection-item">
                                                    </li>
                                                    <li class="collection-item">
                                                    </li>
                                                </ul>

                                            </div>
                                        </li>
                                    <?php }} else { ?>
                                    <li> <div class="collapsible-header">Бүгүн радиолордон ырыңыз кете элек...</div></li>
                                <?php } ?>
                            </ul>

                        </div>

                    </div>

                </div>


            </div>

        </div>
    </div>

<?php include('footer.php'); ?>
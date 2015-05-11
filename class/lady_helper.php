<?php

$last_monday = strtotime('last monday', strtotime('tomorrow'));

$weekday = date('w');

if (1) {
    $dateLast[] = $last_monday;
    $dateStart[] = strtotime('-7 days', $dateLast[0]);

} else {
    $dateLast[] = strtotime('-7 days', $last_monday);
    $dateStart[] = strtotime('-7 days', $dateLast[0]);
}

$dateStart[] = strtotime('-7 days', $dateStart[0]);
$dateStart[] = strtotime('-14 days', $dateStart[0]);
$dateStart[] = strtotime('-21 days', $dateStart[0]);
$dateStart[] = strtotime('-28 days', $dateStart[0]);

$dateLast[] = strtotime('-7 days', $dateLast[0]);
$dateLast[] = strtotime('-14 days', $dateLast[0]);
$dateLast[] = strtotime('-21 days', $dateLast[0]);
$dateLast[] = strtotime('-28 days', $dateLast[0]);

$leader_singer[] = apc_fetch('leader_singer_'.$dateStart[0]);
$leader_singer[] = apc_fetch('leader_singer_'.$dateStart[1]);
$leader_singer[] = apc_fetch('leader_singer_'.$dateStart[2]);
$leader_singer[] = apc_fetch('leader_singer_'.$dateStart[3]);
$leader_singer[] = apc_fetch('leader_singer_'.$dateStart[4]);

$leader_song[] = apc_fetch('leader_song_'.$dateStart[0]);
$leader_song[] = apc_fetch('leader_song_'.$dateStart[1]);
$leader_song[] = apc_fetch('leader_song_'.$dateStart[2]);
$leader_song[] = apc_fetch('leader_song_'.$dateStart[3]);
$leader_song[] = apc_fetch('leader_song_'.$dateStart[4]);

//////////////
/// SINGER STATS
//////////////

$leader_singer_count = count($leader_singer)-1;

for($i=$leader_singer_count; $i>-1; $i--){
    if (!$leader_singer[$i]) {
        $sql_singer = "select a.id as movement, count(pm.track_id) as total, a.name as artist, a.id as artist_id
			from played_melody pm, artist a,artist_melody am,melody m
			where a.id = am.artist_id
			and am.melody_id = m.id
			and pm.date_played >= '".date("Y-m-d",$dateStart[$i])."' and pm.date_played < '".date("Y-m-d",$dateLast[$i])."' 
			and m.track_id=pm.track_id
			GROUP BY a.name,a.id
			ORDER BY total desc
			LIMIT 0,50";
        $leader_singer_result = $db->selectpuresql($sql_singer);
        $counter=1;
        $last_key = count($leader_singer_result)-1;

        $same_counter_start = -1;
        $same_counter_flag = false;
        $movement_array = array();

        foreach($leader_singer_result as $key=>&$singer){
            $singer['movement'] = 0.5;


            if ($key>0 && $singer['total'] == $leader_singer_result[$key-1]['total']) {
                $singer['real_counter'] = $leader_singer_result[$key-1]['real_counter'];
                if (!$same_counter_flag) {
                    $same_counter_start = $key-1;
                    $same_counter_flag = true;
                }
                $counter++;
            }
            else {
                $singer['real_counter'] = $counter++;
                $same_counter_start = -1;
                $same_counter_flag = false;
                $movement_array = array();
            }
            $artist_id = $singer['artist_id'];
            $movement_array[$artist_id] = 1000;

            if ($i<$leader_singer_count){
                foreach($leader_singer[$i+1] as $keylast=>$singerlast){
                    if ($singer['artist_id'] == $singerlast['artist_id']){
                        $singer['movement'] = $singerlast['real_counter'] - $singer['real_counter'];
                        $movement_array[$artist_id] = $singer['movement'];
                        break;
                    }
                }
            }

            if ($same_counter_flag && ($key==$last_key || $singer['total'] != $leader_singer_result[$key+1]['total']))
            {
                asort($movement_array);
                $k = -1;
                foreach($movement_array as $move_key=>$move){
                    {
                        $k++;
                        for($j=0, $iii = $same_counter_start; $iii <= $key; $j++, $iii++){

                            if ($leader_singer_result[$iii]['artist_id'] == $move_key){

                                $leader_singer_result[$iii]['real_counter'] += $k;

                                if ($leader_singer_result[$iii]['movement']!=0.5)
                                    $leader_singer_result[$iii]['movement'] = $leader_singer_result[$iii]['movement'] - $k;

                                $move_position = $k - $j;

                                if ($move_position!=0){

                                    $temp_singer  = $leader_singer_result[$iii];
                                    $leader_singer_result[$iii] = $leader_singer_result[$iii+$move_position];
                                    $leader_singer_result[$iii+$move_position] = $temp_singer;
                                }
                                break;
                            }
                        }
                    }
                }
            }


        }


        $leader_singer[$i] = $leader_singer_result;
        apc_store('leader_singer_'.$dateStart[$i],new ArrayObject($leader_singer_result));
        //if ($i==0) apc_store('leader_singer_1_'.$dateStart[$i],new ArrayObject($leader_singer_result),300);
        //else apc_store('leader_singer_'.$dateStart[$i],new ArrayObject($leader_singer_result));
    }
}


//////////////
/// SONG STATS
//////////////

$leader_song_count = count($leader_song)-1;

for($i=$leader_song_count; $i>-1; $i--){
    if (!$leader_song[$i]) {
        $sql_singer = "select count(pm.track_id) as total, m.track_id,  am.artist_id as artist_id, m.song, m.id as melody_id, a.name as artist_name
			from played_melody pm, artist_melody am, melody m,artist a
			where am.melody_id = m.id
			and am.melody_id = m.id
			and am.artist_id = a.id
			and pm.date_played >= '".date("Y-m-d",$dateStart[$i])."' and pm.date_played < '".date("Y-m-d",$dateLast[$i])."' 
			and m.track_id=pm.track_id
			GROUP BY am.melody_id,am.artist_id,m.song
			ORDER BY total desc, m.id, m.song asc
			LIMIT 0,70";

        //echo $sql_singer;

        $leader_song_result1 = $db->selectpuresql($sql_singer);
        $leader_song_result = array();

        $temp_max = count($leader_song_result1)-1;
        foreach($leader_song_result1 as $key=>&$singer){
            if ($key>0 && $singer['melody_id'] == $leader_song_result1[$key-1]['melody_id']) continue;
            $temp_id = $key;
            while ($key!=$temp_max && $leader_song_result1[$temp_id]['melody_id'] == $leader_song_result1[$temp_id+1]['melody_id']){
                $singer['artist_name'] .= ", ".$leader_song_result1[$temp_id+1]['artist_name'];
                $temp_id++;
            }
            $leader_song_result[] = $singer;

        }

        $counter=1;

        $last_key = count($leader_song_result)-1;
        $same_counter_start = -1;
        $same_counter_flag = false;
        $movement_array = array();

        foreach($leader_song_result as $key=>&$singer){

            $singer['movement'] = 0.5;

            if ($key>0 && $singer['total'] == $leader_song_result[$key-1]['total']) {
                $singer['real_counter'] = $leader_song_result[$key-1]['real_counter'];
                if (!$same_counter_flag) {
                    $same_counter_start = $key-1;
                    $same_counter_flag = true;
                }
                $counter++;
            }
            else {
                $singer['real_counter'] = $counter++;
                $same_counter_start = -1;
                $same_counter_flag = false;
                $movement_array = array();
            }

            $melody_id = $singer['melody_id'];
            $movement_array[$melody_id] = 1000;

            if ($i<$leader_song_count){
                foreach($leader_song[$i+1] as $keylast=>$singerlast){
                    if ($singer['melody_id'] == $singerlast['melody_id']){
                        $singer['movement'] = $singerlast['real_counter'] - $singer['real_counter'];
                        $movement_array[$melody_id] = $singer['movement'];
                        break;
                    }
                }
            }

            if ($same_counter_flag && ($key==$last_key || $singer['total'] != $leader_song_result[$key+1]['total']))
            {
                asort($movement_array);
                $k = -1;
                foreach($movement_array as $move_key=>$move){
                    {
                        $k++;
                        for($j=0, $iii = $same_counter_start; $iii <= $key; $j++, $iii++){

                            if ($leader_song_result[$iii]['melody_id'] == $move_key){
                                $leader_song_result[$iii]['real_counter'] += $k;
                                if ($leader_song_result[$iii]['movement']!=0.5)
                                    $leader_song_result[$iii]['movement'] = $leader_song_result[$iii]['movement'] - $k;
                                $move_position = $k - $j;
                                if ($move_position!=0){
                                    $temp_singer  = $leader_song_result[$iii];
                                    $leader_song_result[$iii] = $leader_song_result[$iii+$move_position];
                                    $leader_song_result[$iii+$move_position] = $temp_singer;
                                }
                                break;
                            }
                        }
                    }
                }
            }

        }
        $leader_song[$i] = $leader_song_result;
        apc_store('leader_song_'.$dateStart[$i],new ArrayObject($leader_song_result));
        //if ($i==0) apc_store('leader_song_1_'.$dateStart[$i],new ArrayObject($leader_song_result),300);
        //else apc_store('leader_song_'.$dateStart[$i],new ArrayObject($leader_song_result));
    }
}
?>
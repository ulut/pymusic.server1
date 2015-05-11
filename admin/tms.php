<?php

include('header.php');
include('nav.php');

?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Logs</h4>
            </div>

        </div>
        <div class="row">

                <?php
				
				$cc = $db -> selectpuresql("SELECT * FROM  logs where userid > 9 group by userid");
				$ccd = $db -> selectpuresql("SELECT * FROM  logs where userid > 9");
				
				echo count($cc)." адам сайтка ".count($ccd)." жолу кирди</br>";
				
                $rr = $db -> selectpuresql("SELECT * FROM  logs where userid > 9 or userid=0 order by log_id desc LIMIT 100");
                foreach($rr as $r){
					if ($r['userid']>0){
						echo '<font color="green">'.$r['date_view'].' '.$r['time_view'].' '.$r['message'].'</font></br>';
					}
                    else echo $r['date_view'].' '.$r['time_view'].' '.$r['message'].'</br>';
                }
                ?>

        </div>
    </div>

<?php
include'footer.php';
?>
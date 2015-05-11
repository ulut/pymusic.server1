<?php

include('header.php');
include('nav.php');

?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Салыштыруулар</h4>
            </div>

        </div>
        <div class="row">

                <?php
				
				$cc = $db -> selectpuresql("SELECT * FROM logcompare order by log_id desc");
				
				$count = 0;
				
                foreach($rr as $r){
				
					if (++$count%2){
						echo '<font color="green">'.$r['username'].' --> '.$r['singername1'].' vs '.$r['singername1'].'</font></br>';
					}
                    else echo $r['username'].' --> '.$r['singername1'].' vs '.$r['singername1'].'</br>';
                }
                ?>

        </div>
    </div>

<?php
include'footer.php';
?>
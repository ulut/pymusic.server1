<?php
include('user_control.php');
include('header.php');
include('nav.php');

$art_id = getget('id');
$_artist_melody=$db->selectpuresql("select m.song from artist_melody a inner join melody m on a.melody_id = m.id where a.artist_id='".$art_id."'");
$_artist_melody2=$db->selectpuresql("select m.song from uploaded_artist_melody a inner join melody m on a.melody_id = m.id where a.artist_id='".$art_id."'");
$artist=$db->select_one("artist","id=".$art_id);
if($_POST['submit']){
    $art_id = $_POST['hidden'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $phonenumber = $_POST['phonenumber'];
    if($phonenumber == '[бош]'){
        $phonenumber = '';
    }
    if(isset($_POST['is_composer'])){
        $is_composer = 1;
    }
    if(isset($_POST['is_arranger'])){
            $is_arranger = 1;
        }
    if(isset($_POST['is_composer'])){
            $is_composer = 1;
        }
    if(isset($_POST['is_akyn'])){
            $is_akyn = 1;
        }
    if(isset($_POST['is_producer'])){
            $is_producer = 1;
        }
    if(isset($_POST['is_singer'])){
                $is_singer = 1;
            }
    $update = array(
        "name" => $name,
        "gender" => $gender,
        "birthdate" => $birthdate,
        "active" => NULL,
        "phonenumber" => $phonenumber,
        "is_singer" => $is_singer,
        "is_compositor" => $is_composer,
        "is_editor" => $is_akyn,
        "is_arranger" => $is_arranger,
        "is_producer" => $is_producer
    );
    $r=$db->update("artist",$update,"id=".$art_id);
    if($r){
        redirect('artist_list.php','js');
    }else{
        echo "not updating";
    }
}


?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-header">Ырчынын атын озгортуу</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-1 col-md-4">
        <form action="" method="post">
            <input type="hidden" name="hidden" value="<?=$art_id;?>">
            <div class="form-group input-group">
                <label>Ырчынын аты</label>
                <input type="text" class="form-control"  value="<?=empty($artist['name'])?"[бош]":$artist['name'];?>" required="required" name="name">
            </div>
            <div class="form-group input-group">
                <label>Пол</label>
                <select name="gender" class="form-control">
                    <option value="m">эркек</option>
                    <option value="f">аял</option>
                </select>
            </div>
            <div class="form-group input-group">
                <label>Туулган куну</label>
                <input type="date" class="form-control"  value="<?=empty($artist['birthdate'])?"[бош]":$artist['birthdate'];?>" name="birthdate">
            </div>
            <div class="form-group input-group">
                <label>Телефон</label>
                <input type="text" class="form-control"  value="<?=empty($artist['phonenumber'])?"[бош]":$artist['phonenumber'];?>" name="phonenumber">
            </div>
            <div class="form-group input-group">
                <label>Аткаруучу</label><div class="col-md-offset-1"></div>
                <input type="checkbox" name="is_singer" value="0">
            </div>
            <div class="form-group input-group">
                <label>Ырдын сѳзүн жазган акын</label><div class="col-md-offset-1"></div>
                <input type="checkbox" name="is_akyn" value="0">
            </div>
            <div class="form-group input-group">
                <label>Композитор</label><div class="col-md-offset-1"></div>
                <input type="checkbox" name="is_composer" value="0">
            </div>
            <div class="form-group input-group">
                <label>Аранжировщик</label><div class="col-md-offset-1"></div>
                <input type="checkbox" name="is_arranger" value="0">
            </div>
            <div class="form-group input-group">
                <label>Yн режиссёр</label><div class="col-md-offset-1"></div>
                <input type="checkbox" name="is_producer" value="0">
            </div>
            <?php
            if(count($_artist_melody)+count($_artist_melody2)){
            ?>



            <h4>Ырчынын ырлары: </h4>
            <hr>
            <?php
            foreach ($_artist_melody as $art_tie){
                $count++;
                echo '<div class="row"><h5 class="col-md-1">'.$count.'</h5><h5 class="col-md-offset-1 col-md-5">'.$art_tie['song'].'</h5></div>';
            }

                foreach ($_artist_melody2 as $art_tie){
                    $count++;
                    echo '<div class="row"><h5 class="col-md-1">'.$count.'</h5><h5 class="col-md-offset-1 col-md-5">'.$art_tie['song'].'</h5></div>';
                }

            }else{
            ?>

            <div class="form-group input-group">
                <a href="artist_delete.php?delete_id=<?=$art_id;?>" class="btn btn-primary">Өчүр</a>
            </div>
<?php } ?>
            <div class="form-group input-group">
                <input type="submit" class="btn btn-primary" name="submit" value="ok">
            </div>

        </form>
    </div>
    </div>

</div>
<?php
    include 'footer.php';
?>



<!--alter table artist add column is_akyn TINYINT( 1 ) DEFAULT  '0';   ok -->
<!--alter table artist add column is_composer TINYINT( 1 ) DEFAULT  '0';   ok-->
<!--alter table artist add column is_arranger TINYINT( 1 ) DEFAULT  '0';-->
<!--ALTER TABLE artist-->
<!--MODIFY COLUMN is_singer TINYINT( 1 ) DEFAULT  '1'-->
<!--alter table artist add column is_producer TINYINT( 1 ) DEFAULT  '0';-->
<!--alter table artist add column is_singer TINYINT( 1 ) DEFAULT  '0';-->

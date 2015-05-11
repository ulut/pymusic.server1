<?php

include('header.php');
include('nav.php');
$result = $db-> selectpuresql('select count(a.id) as count_artist_id, a.name as artist_name from artist as a INNER JOIN user_tie as tie ON a.id = tie.singer_id where tie.user_id =  '.$_SESSION['id'].'');

if(isset($_POST['sb'])) {
     $user_name = $_SESSION['username'];
     $singer_name = $_POST['singer_name'];
     $song_name = $_POST['song_name'];
     $akyn = $_POST['akyn'];
     $composer = $_POST['composer'];
     $arranger = $_POST['arranger'];
     $producer = $_POST['producer'];
     $year = $_POST['year'];
     $genre = $_POST['genre'];

//    CREATE TABLE uploaded_song (id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,singer_name VARCHAR(100) NOT NULL,passport_name VARCHAR(100),song_name VARCHAR(100) NOT NULL,akyn VARCHAR(100) NOT NULL,composer VARCHAR(100) NOT NULL,arranger VARCHAR(100) NOT NULL,producer VARCHAR(100) NOT NULL,year INT(5) NOT NULL,genre VARCHAR(100) NOT NULL,filename VARCHAR(2048) NOT NULL,uploaded_date TIMESTAMP);

    $dir = "/home/monitor/Music/uploaded_song/";

// If File Submitted
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if ( $ext == "mp3") {
            if( $_FILES['file']['size'] < 1024*1024*1024*1024 ){
                 $uniq = base_convert(uniqid(), 16, 10);
                 $tmp = $_FILES['file']['tmp_name'];
                 $uniq_file_name = $uniq.".".$ext;
                if(move_uploaded_file($tmp, $dir.$uniq_file_name)){

                    $insert = array(
                        "username" => $user_name,
                        "singer_name" => $singer_name,
                        "song_name" => $song_name,
                        "akyn" => $akyn,
                        "composer" => $composer,
                        "arranger" => $arranger,
                        "producer" => $producer,
                        "year" => $year,
                        "genre" => $genre,
                        "filename" => $dir.$uniq_file_name
                    );
                    $result = $db->insert("uploaded_song",$insert);
                    $msg = "Файл ийгиликтүү жүктѳлдү!";
                }
                else{
                    $msg = "Проблема!!! Билбейм эмнеге!!!";
                }
            }
            else{
                $msg = "Файлдын размери аябай чоң!";
            }
        }
        else{
            $msg = "Бир гана mp3 форматтагы файлдарды жүктѳй аласыз!";
        }
    }


}

?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Ырды тандап жүктѳңүз</h4>
            </div>
            <?php
            if(isset($msg)){
                echo "<p>{$msg}</p>\n";
            }
            ?>


        </div>
        <div class="row">
            <div class="col-md-5">
                <form action="" id="uploadForm" method="POST" onsubmit="return Validate(this);" enctype="multipart/form-data">
                <div class="form-group input-group">
                    <label>Ырчы же ырчылардын аттарын жазыңыз</label>
                    <?php
                        if($result[0]['count_artist_id']<=1){

                    ?>
                        <input type="text" class="form-control" placeholder="Ырчынын аты" required="required" name="singer_name" value="<?=$artist['artist_name'];?>"><br>

                    <?php
                        }else{
                    ?>
                        <input type="text" class="form-control" placeholder="Ырчынын аты" required="required" name="singer_name"><br>
                    <?php }   ?>
                </div>

                    <div class="form-group input-group">
                        <input type="text"  class="form-control" placeholder="Ырдын аты" required="required" name="song_name"><br>
                    </div>

                    <div class="form-group input-group">
                        <input type="text"  class="form-control" name="akyn" placeholder="Ырдын сѳзүн жазган акын"><br>
                    </div>

                    <div class="form-group input-group">
                        <input type="text"  class="form-control" name="composer" placeholder="Композитор"><br>
                    </div>

                    <div class="form-group input-group">
                        <input type="text" class="form-control" name="arranger" placeholder="Аранжировщик"><br>
                    </div>

                    <div class="form-group input-group">
                        <input type="text"  class="form-control" name="producer" placeholder="Yн режиссёр"><br>
                    </div>

                    <div class="form-group input-group">
                        <input type="number"  class="form-control" name="year" placeholder="Жылы">
                    </div>

                    <div class="form-group input-group">
                        <select name="genre" class="form-control">
<!--                            <option value=''>Жанр</option>-->
                            <?php
                            $genre=$db->select('genre');
                            foreach($genre as $g_name){
                            ?>
                            <option value="<?=$g_name['id'];?>"><?=$g_name['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group input-group">
                        <label for="chooseFile">Танда</label>
                        <input type="file" required="required" name="file" id="file"><br/>
                        <input class="btn btn-primary" type="submit" name="sb" id="sb" value="Жүктѳ"><br><br>
                    </div>

                </form>

            </div>
            <div class="col-md-5">
                <?php
                $rr = $db -> selectpuresql("SELECT * FROM uploaded_song WHERE user_id =".$_SESSION['username']."");
                foreach($rr as $r){
                    $c++;
                    echo '<h5>'.$c.' '.$r['song_name'].'</h5>';
                }
                ?>
            </div>
        </div>
    </div>


<?php
include'footer.php';
?>


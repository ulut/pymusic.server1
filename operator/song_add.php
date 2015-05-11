<?php

include 'user_control.php';
include('header.php');
include('nav.php');

if(isset($_POST['sb'])) {
    $user_name = $_SESSION['user_name'];
    $singer_name = $_POST['singer_name'];
    $song_name = $_POST['song_name'];
    $akyn = $_POST['akyn'];
    $composer = $_POST['composer'];
    $arranger = $_POST['arranger'];
    $producer = $_POST['producer'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];



    $valid_format = "mp3";
    $max_file_size = 1024*1024*1024*1024;
    $dir = "/home/monitor/Music/uploaded_song/";

// If File Submitted
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if ( $ext == $valid_format) {
            if( $_FILES['file']['size'] < $max_file_size ){
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
if($result) echo "y";
                    else echo "n";
                    $msg = "Файл ийгиликтүү жүктѳлдү!";
                }
                else{
                    $msg = "Проблема!!! Билбейм эмнеге!!!";
                }
            }
            else{
                $msg = "Файлдын размери аябай чон!";
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
                <h4 style="color:red">Ырдын жыштыгы минимум 44.1кГц болсун!!!</h4>
                <h4 style="color:red">Бир гана mp3 форматтагы файлдарды жүктѳй аласыз!!!</h4>
                <form action="" method="POST" onsubmit="return Validate(this);" enctype="multipart/form-data">
                    <div class="form-group input-group">
                        <input type="text"  class="form-control" placeholder="Ырчынын сахнадагы аты" required="required" name="singer_name"><br>
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
                        <label for="genre">Танда</label>
                        <input type="file" required="required" name="file" id="file"><br/>
                        <input class="btn btn-primary" type="submit" name="sb" id="sb" value="Жүктѳ"><br><br>
                    </div>


                </form>
            </div>
        </div>
    </div>

<?php
include'footer.php';
?>
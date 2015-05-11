<?php

include('header.php');
include('nav.php');
$result = $db-> selectpuresql('select a.id as artist_id, a.name as artist_name from artist as a INNER JOIN user_tie as tie ON a.id = tie.singer_id where tie.user_id =  '.$_SESSION['id'].'');

if(isset($_POST['sb'])) {
    $singer_name = $_POST['singer_name'];
    $song_name = $_POST['song_name'];
    $akyn = $_POST['akyn'];
    $composer = $_POST['composer'];
    $arranger = $_POST['arranger'];
    $producer = $_POST['producer'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $date = date("y.m.d");
//    $date1 = strtotime($date);
//    $date2 = date("Y-m-d",$date1);

//    CREATE TABLE uploaded_song (id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,singer_name VARCHAR(100) NOT NULL,passport_name VARCHAR(100),song_name VARCHAR(100) NOT NULL,akyn VARCHAR(100) NOT NULL,composer VARCHAR(100) NOT NULL,arranger VARCHAR(100) NOT NULL,producer VARCHAR(100) NOT NULL,year INT(5) NOT NULL,genre VARCHAR(100) NOT NULL,filename VARCHAR(2048) NOT NULL,uploaded_date TIMESTAMP);




    $path = "/home/monitor/Music/uploaded_song";

    $file = $_FILES['filetoupload']['name'];

    $filename = "$path/$file";


if(!function_exists('mime_content_types')) {

    function mime_content_types($filename) {

        $mime_types = array(

            // audio/video
            'mp3' => 'audio/mpeg',

        );
        global $path, $file;
        $ext = strtolower(array_pop(explode('.',$filename)));
        if (array_key_exists($ext, $mime_types)) {
            global $success_message;
            $success_message = "Файл ийгиликтүү жүктѳлдү!";
            move_uploaded_file($_FILES['filetoupload']['tmp_name'], "$path/$file");

        }
        else {
            global $error_message;
            $error_message = 'Бир гана mp3 форматтагы файлдарды жүктѳй аласыз!';
        }
    }
    mime_content_types($_FILES['filetoupload']['name']);

}
    $insert = array(
        "singer_name" => $singer_name,
        "song_name" => $song_name,
        "akyn" => $akyn,
        "composer" => $composer,
        "arranger" => $arranger,
        "producer" => $producer,
        "year" => $year,
        "genre" => $genre,
        "filename" => $filename,
        "uploaded_date" => $date
    );
    $result = $db->insert("uploaded_song",$insert);

}

?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Ырды тандап жүктѳңүз</h4>
            </div>
            <!-- /.col-lg-12 -->
            <b><span style="color: red"><?=$error_message;?></span></b>
            <b><span style="color: #42c34c"><?=$success_message;?></span> </b>

        </div>
        <div class="row">
            <div class="col-md-5">
                <form action="" method="POST" onsubmit="return Validate(this);" enctype="multipart/form-data">
                    <div class="form-group input-group">
                        <label for="singer_name">Ырчынын сахнадагы аты</label>
                        <select required="required" class="form-control" name="singer_name">

                                <?php
                                foreach ($result as $artists) {
                                    ?>

                            <?php
                                echo '<option value="'.$artists['artist_id'].'">'.$artists['artist_name'].'</option>';
                            }

                            ?>
                        </select>
                    </div>

                    <div class="form-group input-group">
                        <label for="song_name">Ырдын аты</label>
                        <input type="text"  class="form-control" required="required" name="song_name"><br>
                    </div>

                    <div class="form-group input-group">
                        <label for="akyn">Ырдын сѳзүн жазган акын</label>
                    <input type="text"  class="form-control" required="required" name="akyn"><br>
                    </div>

                    <div class="form-group input-group">
                        <label for="composer">Композитор</label>
                        <input type="text"  class="form-control" required="required" name="composer"><br>
                    </div>

                    <div class="form-group input-group">
                        <label for="arranger">Аранжировщик</label>
                        <input type="text" class="form-control" required="required" name="arranger"><br>
                    </div>

                    <div class="form-group input-group">
                        <label for="producer">Yн режиссёр</label>
                        <input type="text"  class="form-control" required="required" name="producer"><br>
                    </div>

                    <div class="form-group input-group">
                        <label for="year">Жылы</label>
                        <input type="number"  class="form-control" name="year">
                    </div>

                    <div class="form-group input-group">
                        <label for="genre">Жанр</label>
                        <input type="text"  class="form-control" name="genre">
                    </div>

                    <div class="form-group input-group">
                        <label for="genre">Танда</label>
                        <input type="file" required="required" name="filetoupload" id="filetoupload"><br/>
                        <input class="btn btn-primary" type="submit" name="sb" id="sb" value="Жүктѳ"><br><br>
                    </div>



                </form>
            </div>
        </div>
    </div>


<?php
include'footer.php';
?>
<?php
include('main_header.php');
include('header.php');

if(isset($_POST['singer_name'])) {
     
	 $user_name = $_SESSION['user_name'];
     $singer_name = getpost('singer_name');
     $song_name = getpost('song_name');
     $akyn = getpost('akyn');
     $composer = getpost('composer');
     $arranger = getpost('arranger');
     $producer = getpost('producer');
     $year = getpost('year');
     $genre = getpost('genre');

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
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>


    <div class="content container">
        <div class="row">

            <div class="col s12 m12 l10 offset-l1">
                <div class="card white z-depth-2 radios">
                    <div class="card-content no-padding">
                        <h4 class="card-title center">
                            Ыр кош
                        </h4>
<?php
            if(isset($msg)){
                echo "<p class='style1'>{$msg}</p>\n";
				die();
            }
            ?>                        <div class="row">
                            
							<form action="" id="uploadForm" method="POST" onsubmit="return Validate(this);" enctype="multipart/form-data"  class="col s12 l10 offset-l1 m10 offset-m1 song-form">
                                <div class="row">
                                    <div class="input-field center col s12 m6 l6">
                                        <input name="singer_name" id="singer_name" type="text" <?php if (count($singer_list)==1) {?> value="<?=$singer_list[0]['name'];?>"<?php } ?> class="validate">
                                        <label>Ырчы</label>
                                    </div>
                                    <div class="input-field col s12 m6 l6">
                                        <input name="song_name" id="song_name" type="text" class="validate">
                                        <label for="song_name">Ырдын аты</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m6 l6">
                                        <input name="akyn" id="song_text" type="text" class="validate">
                                        <label for="song_text">Ырдын сѳзүн жазган акын</label>
                                    </div>
                                    <div class="input-field col s12 m6 l6">
                                        <input name="composer" id="song_music" type="text" class="validate">
                                        <label for="song_music">Композитор</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m6 l6">
                                        <input name="arranger" id="song_editor" type="text" class="validate">
                                        <label for="song_editor">Аранжировщик</label>
                                    </div>
                                    <div class="input-field col s12 m6 l6">
                                        <input name="producer" id="song_music_director" type="text" class="validate">
                                        <label for="song_music_director">Yн режиссёр</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m6 l6">
                                        <input name="year" id="song_year" type="text" class="validate">
                                        <label for="song_year">Жылы</label>
                                    </div>
                                    <div class="input-field col s12 m6 l6">
                                        
										<select name="genre" class="validate">
<!--                            <option value=''>Жанр</option>-->
                            <?php
                            $genre=$db->select('genre');
                            foreach($genre as $g_name){
                            ?>
                            <option value="<?=$g_name['id'];?>"><?=$g_name['name'];?></option>
                            <?php } ?>
                        				</select>
                                        <label for="song_genre">Жанр</label>
                                    </div>
                                </div>
                                <div class="file-field input-field">
                                    
                                </div>
                                <div class="row">
                                  <div class="input-field center">
                                       <input type="file" required="required" name="file" id="file"> 
									   <input class="btn btn-primary" type="submit" name="sb" id="sb" value="Жүктѳ"><br />
                                       <span class="style1">Ырдын жыштыгы минимум 44.1кГц болуусу керек. <br> Бир гана mp3 форматтагы файлдарды жүктѳй аласыз.</span>
                                  </div>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php include('footer.php'); ?>
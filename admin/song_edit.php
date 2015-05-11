<?php
include("header.php");
$song_id = $_GET['id'];
$get_singer_song = $db->select_one("uploaded_song","id=".$song_id);
if(isset($_POST['add_artist_tie'])){
    $song_id = $_POST['hidden'];
    $artist_id = $_POST['singer_name'];
    $insert_array = array(
        "artist_id"=>$artist_id,
        "melody_id"=>$song_id
    );
    $result = $db->insert("uploaded_artist_melody",$insert_array);

}
if(isset($_POST["edit_artist_tie"])){
    $tie_id = getpost('tie_id');
    $song_id = getpost('hidden');
    $artist_id = getpost('singer_name');
    $info = array("artist_id" => $artist_id);
    $result = $db->update("uploaded_artist_melody",$info,"melody_id='".$song_id."' AND id='".$tie_id."'");
    if($result) echo "y"; else echo "n";
}
if(isset($_POST['sb'])) {
    $song_id = $_POST['hidden'];
    $user_name = $_SESSION['user_name'];
    $singer_name = $_POST['singer_name'];
    $song_name = $_POST['song_name'];
    $akyn = $_POST['akyn'];
    $composer = $_POST['composer'];
    $arranger = $_POST['arranger'];
    $producer = $_POST['producer'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];

    $update = array(
        "id" => $song_id,
        "username" => $user_name,
        "singer_name" => $singer_name,
        "song_name" => $song_name,
        "akyn" => $akyn,
        "composer" => $composer,
        "arranger" => $arranger,
        "producer" => $producer,
        "year" => $year,
        "genre" => $genre
    );


    $result = $db->update("uploaded_song",$update,"id=".$song_id);
    redirect("unproved_songs.php","js");
}
$art_mel_tie = $db->selectpuresql("select * from uploaded_artist_melody where melody_id = '".$song_id."'");
$art_mel_tie_count = $db->selectpuresql("select count(artist_id) as count_id from uploaded_artist_melody where melody_id = '".$song_id."'");
?>
<!-- Navigation -->
<?php
include("nav.php");
?>





<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Изменить</h1>
        </div>
    </div>

    <div class="row">


                <label>Ырчынын сахнадагы аты</label>
                <h4 style="color: darkmagenta"><?=$get_singer_song['singer_name'];?></h4>
                <?php
                if($art_mel_tie_count[0]['count_id'] >= 1){
                    foreach($art_mel_tie as $tie){
                        ?>
                        <div class="row">
                            <form class="little" action="" method="POST">
                                <input type="hidden" name="hidden" value="<?php echo $song_id;?>">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="ui-widget">
                                            <select id="combobox<?=$tie['artist_id'];?>" required="required" name="singer_name" class="form-control">
                                                <option value="">Ырчынын сахнадагы аты</option>
                                                <?php
                                                $artist = $db->select("artist","is_singer = 1");
                                                foreach($artist as $art){
                                                    ?>
                                                    <option value="<?php echo $art['id']; ?>" <?php if($tie['artist_id']==$art['id']) echo "selected";?>><?php echo $art['name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <script type="text/javascript">
                                                $(function() {
                                                    $( "#combobox<?=$tie['artist_id'];?>" ).combobox();
                                                    $( "#toggle" ).click(function() {
                                                        $( "#combobox<?=$tie['artist_id'];?>" ).toggle();
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="hidden" name="tie_id" value="<?=$tie['id'];?>">
                                        <input type="submit" name="edit_artist_tie" value="Алмаштыр" class="btn btn-primary">
                                        <!--                                                                <a href="song_edit.php?edit_artist_tie=--><?//=$tie['id'];?><!--" class="btn btn-primary">Алмаштыр</a>-->
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                    <?php
                    }
                }
                ?>
                <div class="row">
                    <form id="kow" action="" method="POST">
                        <input type="hidden" name="hidden" value="<?php echo $song_id;?>">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="ui-widget">
                                    <select id="combobox" required="required" name="singer_name" class="form-control">
                                        <option value="">Ырчынын сахнадагы аты</option>
                                        <?php
                                        $artist = $db->select("artist","is_singer = 1");
                                        foreach($artist as $art){
                                            ?>
                                            <option value="<?php echo $art['id']; ?>"><?php echo $art['name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <input type="submit" name="add_artist_tie" value="Аткаруучу кош" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>




    <form id="40n" role="form" action="song_edit.php" method="post">
        <input type="hidden" name="hidden" value="<?php echo $song_id;?>">

            <div class="form-group input-group">
                <label>Ырдын аты</label>
                <input type="text"  class="form-control" placeholder="Ырдын аты" required="required" name="song_name" value="<?=$get_singer_song['song_name'];?>"><br>
            </div>

            <div class="form-group input-group">
                <label>Ырдын сѳзүн жазган акын</label>
                <input type="text"  class="form-control" name="akyn" placeholder="Ырдын сѳзүн жазган акын" value="<?=$get_singer_song['akyn'];?>"><br>
            </div>

            <div class="form-group input-group">
                <label>Композитор</label>
                <input type="text"  class="form-control" name="composer" placeholder="Композитор" value="<?=$get_singer_song['composer'];?>"><br>
            </div>

            <div class="form-group input-group">
                <label>Аранжировщик</label>
                <input type="text" class="form-control" name="arranger" placeholder="Аранжировщик" value="<?=$get_singer_song['arranger'];?>"><br>
            </div>

            <div class="form-group input-group">
                <label>Yн режиссёр</label>
                <input type="text"  class="form-control" name="producer" placeholder="Yн режиссёр" value="<?=$get_singer_song['producer'];?>"><br>
            </div>

            <div class="form-group input-group">
                <label>Жылы</label>
                <input type="number"  class="form-control" name="year" placeholder="Жылы" value="<?=$get_singer_song['year'];?>">
            </div>

            <div class="form-group input-group">
                <label>Жанр</label>
                <select name="genre" class="form-control">
                    <!--                    <option value=''></option>-->
                    <?php
                    $genre=$db->select('genre');
                    foreach($genre as $g_name){
                        ?>
                        <option value="<?=$g_name['id'];?>" <?php if($g_name['id']==$get_singer_song['genre']) echo "selected";?>><?=$g_name['name'];?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group input-group">
                <input class="btn btn-primary" type="submit" name="sb" value="Save"><br><br>
            </div>

        </form>
    </div>
</div>



        <?php
        include("footer.php");
        ?>

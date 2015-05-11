<?php
include('user_control.php');
include('header.php');
include('nav.php');


$artist_id=0;
if(isset($_GET['artist_id'])) $artist_id = getget('artist_id');
if(isset($_POST['artist_id'])) $artist_id = getpost('artist_id');

if ($artist_id){
    $artists=$db->select("artist","id='".$artist_id."'","id, name");
}else if(isset($_GET['letter'])){
    $letter = getget('letter');
    if($letter == '0'){
        $query = "select * from artist where name  REGEXP '^[^А-Яа-я]' and not(name like 'Ө%' or name like 'Ү%')";
        $artists=$db->selectpuresql($query);
    }
	else $artists=$db->select("artist","name like '".$letter."%'");
}else{
    $artists=$db->select("artist");
}

?>
    <script type="text/javascript">
        var btns = "";
        var letters = "АБВГДЕЁЖЗИЙКЛМНОӨПРСТУҮФХЦЧШЩЪЫЬЭЮЯ";
        var letterArray = letters.split("");
        for(var i = 0; i < 26; i++){
            var letter = letterArray.shift();
            btns += '<button class="mybtns" onclick="alphabetSearch(\''+letter+'\');">'+letter+'</button>';
        }
        btns += '<button class="mybtns" onclick="alphabetSearch(0);">Башкалар</button>';

        btns += '';

        function alphabetSearch(letter){
            window.location = "artist_list.php?letter="+letter;
        }
    </script>

<div id="page-wrapper">
    <div class="row">

        <script>document.write(btns); </script>

        <div class="col-lg-12">
            <h4 class="page-header">Ырчылар</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <form action="" method="post">
        <div class="row">
            <div class="form-group col-md-5">
                <div class="ui-widget">
                    <label for="singer">Аткаруучуну танда</label><br>

                    <select id="combobox" name="artist_id" onchange='this.form.submit()' class="form-control">
                        <option value="">Select one...</option>
                        <?php
                        $artist = $db->select("artist");
                        foreach($artist as $art){
                            ?>
                            <option value="<?php echo $art['id']; ?>" <?php if($art['id']==$artist_id) echo "selected"; ?>><?php echo $art['name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>

                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-offset-1 col-md-11">
           <h4 class="col-md-1"><b>№</b></h4>
            <h4 class=" col-md-3"><b>Ырчынын аты</b></h4>
            <h4 class="col-md-offset-1 col-md-2"><b>Өзгөртүү</b></h4>


        </div>
    </div>
    <div class="row">
        <?php
        $count = 0;
        if (isset($artists))foreach($artists as $every_artist){
            $count++;
            ?>
            <div class="col-md-offset-1 col-md-11">
                <h4 class="col-md-1"><?=$count;?></h4>
                <h4 class="col-md-3"><?=empty($every_artist['name'])?"[без имени]":$every_artist['name'];?></h4>
                <a class="col-md-offset-1 col-md-2 btn-primary" href="artist_edit.php?id=<?=$every_artist['id'];?>">edit</a>


             </div>
        <?php
        }
        ?>
    </div>

</div>

<?php
include 'footer.php';
?>
<?php
include('user_control.php');
include('header.php');
include('nav.php');

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $phonenumber = $_POST['phonenumber'];

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
    $insert = array(
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
    $r=$db->insert("artist",$insert);
    if($r){
        redirect('artist_list.php','js');
    }else{
        echo "not inserted";
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
                <div class="form-group input-group">
                    <label>Ырчынын аты</label>
                    <input type="text" class="form-control" required="required" name="name">
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
                    <input type="date" class="form-control" name="birthdate">
                </div>
                <div class="form-group input-group">
                    <label>Телефон</label>
                    <input type="text" class="form-control" name="phonenumber">
                </div>
                <div class="form-group input-group">
                    <label>Аткаруучу</label>
                    <input type="checkbox" name="is_singer" value="0">
                </div>
                <div class="form-group input-group">
                    <label>Ырдын сѳзүн жазган акын</label>
                    <input type="checkbox" name="is_akyn" value="0">
                </div>
                <div class="form-group input-group">
                    <label>Композитор</label>
                    <input type="checkbox" name="is_composer" value="0">
                </div>
                <div class="form-group input-group">
                    <label>Аранжировщик</label>
                    <input type="checkbox" name="is_arranger" value="0">
                </div>
                <div class="form-group input-group">
                    <label>Yн режиссёр</label>
                    <input type="checkbox" name="is_producer" value="0">
                </div>

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

<?php
include("header.php");
include 'nav.php';
$compare=$db->selectpuresql("select u.full_name,art.name n1,a.name n2,l.date_view,l.time_view from logcompare l inner join users u on l.userid = u.id inner join user_tie t on l.singer1 = t.singer_id inner join artist a on l.singer2 = a.id inner join artist art on t.singer_id = art.id where u.id>9 order by log_id desc");
if(isset($_POST['submit'])){
    $date = getpost('date');
    $date = date("d-m-Y",strtotime($date));
    $compare=$db->selectpuresql("select u.full_name,art.name n1,a.name n2,l.date_view,l.time_view from logcompare l inner join users u on l.userid = u.id inner join user_tie t on l.singer1 = t.singer_id inner join artist a on l.singer2 = a.id inner join artist art on t.singer_id = art.id where u.id>9 and l.date_view = '".$date."' order by log_id desc");
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">BATTLE</h1>
        </div>
    </div>
    <form action="" onchange="this.form.submit()" method="post">
        <input type="text" name="date" id="date">
        <input type="submit" class="btn btn-primary" name="submit">
    </form>
    <div class="row">
        <h4 class="col-md-2"><b>Ким</b></h4>
        <h4 class="col-md-3"><b>Кимди</b></h4>
        <h4 class="col-md-3"><b>Ким менен</b></h4>
        <h4 class="col-md-2"><b>Куну</b></h4>
        <h4 class="col-md-2"><b>Саат</b></h4>
    </div>
<?php
foreach($compare as $battle){
    ?>
    <div class="row">
        <h4 class="col-md-2"><?php echo $battle['full_name'];?></h4>
        <h4 class="col-md-3"><?php echo $battle['n1'];?></h4>
        <h4 class="col-md-3"><?php echo $battle['n2'];?></h4>
        <h4 class="col-md-2"><?php echo $battle['date_view'];?></h4>
        <h4 class="col-md-2"><?php echo $battle['time_view'];?></h4>
    </div>
<?php } ?>

    <script type="text/javascript">
        $(function() {
            $( "#date" ).datepicker({
                changeMonth: true,
                numberOfMonths: 1,
                showOtherMonths: true,
                selectOtherMonths: true
                });
            });
    </script>
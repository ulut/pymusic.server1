<?php
include('../config.php');
$results = "";
$letter = "";

if(isset($_GET['letter'])){
    $letter = $_GET['letter'];
    $sql = $db->select("melody","song like '".$letter."%'");
    foreach($sql as $row){
        $results .= $row['song']."<br />";
    }
}
?>
<html>
<body>
<?php echo $results; ?>
</body>
</html>
<?php
include('usercontrol.php');
$today = date("Y-m-d");
$singer_list_query = "select a.* from artist as a inner join user_tie as ut on a.id=ut.singer_id where ut.user_id='".$_SESSION['userid']."' and (ut.is_always = 1 OR (ut.from_date<='".$today."' and ut.to_date>='".$today."'))";
//echo $singer_list_query;
$singer_list = $db->selectpuresql($singer_list_query);

$singer_ids = "0";
			foreach($singer_list as $singer){
				$singer_ids .= ", ".$singer['id'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/liMarquee.css"  media="screen,projection"/>
    <link rel="stylesheet" href="../css/style.css"/>

</head>

<body>
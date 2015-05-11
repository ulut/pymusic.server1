<!DOCTYPE html>
<html>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<head>
    <script type="text/javascript">
        var btns = "";
        var letters = "АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ";
        var letterArray = letters.split("");
        for(var i = 0; i < 26; i++){
            var letter = letterArray.shift();
            btns += '<button class="mybtns" onclick="alphabetSearch(\''+letter+'\');">'+letter+'</button>';
        }
        function alphabetSearch(let){
            window.location = "search_result.php?letter="+let;
        }
    </script>
</head>
<body>
<?php
include('../config.php');

    $artist = 'testartist';
    $song = 'testsong';

    $dir = $db->select_one("melody","id=576");
    $filename = $dir['filename'];
    $mp3 = explode("-", $filename);

    $result = rename("radio/".$mp3[1], 'radio/'.$song.".mp3");

    echo $dir['filename'];
    echo "<hr>";
    echo $result;
?>

<script> document.write(btns); </script>
</body>
</html>
<?php
$result = $db-> selectpuresql('select a.id as artist_id, a.name as artist_name from artist as a INNER JOIN user_tie as tie ON a.id = tie.singer_id where tie.user_id =  '.$_SESSION['id'].'');
$artist_id = $_GET['art_id'];
$flag = false;
foreach($result as $art){

    if($artist_id == $art['artist_id']){
        $flag = true;
    }
    continue;
}
if($flag == false){
    echo '<div class="row"><div class="col-md-offset-3"><p>Ой, кажется что-то пошло не так...</p>
<p>Нам не удалось найти страницу, которую Вы хотели увидеть.</p>
<p>Возможно, ссылка устарела или в адрес страницы закралась опeчатка.</p>
<p>В качестве альтернативы предлагаем:</p>
<ul>
    <li>вернуться к <a href="#" onclick="history.go(-1); return false;">предыдущей странице</a>,</li>
    <li>или перейти на <a href="index.php">главную страницу сайта</a>.</li>
</ul>
</div>
<div class="col-md-offset-2"><img src="images/not_found_image.png"> </div></div>';
    die();
}

//if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
//    $ip = $_SERVER['HTTP_CLIENT_IP'];
//} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
//    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//} else {
//    $ip = $_SERVER['REMOTE_ADDR'];
//}echo $ip;
?>
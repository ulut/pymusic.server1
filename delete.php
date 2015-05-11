<?php
include('config.php');
$all = $db->selectpuresql("select u.*, a.name as aname from users as u inner join user_tie as ut ON ut.user_id = u.id inner join artist a on a.id=ut.singer_id where u.id>10");
$counter = 1;
foreach($all as $user){
	echo "Логин: ".$user['username']."<br>";
	echo "Пароль: ".$user['p']."<br>"."<br>"."<br>"."<br>";
	echo $user['aname']."<br>"."<br>"."<br>"."<br>";
	
}



function transliterate($ru_text) {
	 $cyr  = array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у', 
            'ф','х','ц','ч','ш','щ','ъ', 'ы','ь', 'э', 'ю','я', 'Ө', 'Ү', 'Ң', 'ө', 'ү', 'ң',
			'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У',
            'Ф','Х','Ц','Ч','Ш','Щ','Ъ', 'Ы','Ь', 'Э', 'Ю','Я' );
$lat = array( 'a','b','v','g','d','e','e','zh','z','i','i','k','l','m','n','o','p','r','s','t','u',
            'f' ,'h' ,'ts' ,'ch','sh' ,'sht' ,'i', 'y', '', 'e' ,'yu' ,'ya', 'O', 'U', 'N', 'o', 'u', 'n',
			'A','B','V','G','D','E','E','Zh',
            'Z','I','I','K','L','M','N','O','P','R','S','T','U',
            'F' ,'H' ,'Ts' ,'Ch','Sh' ,'Sht' ,'I' ,'Y' ,'', 'E', 'Yu' ,'Ya' );
	 return str_replace($cyr, $lat, $ru_text);
}

function generatePass($length = 4) {
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
?>
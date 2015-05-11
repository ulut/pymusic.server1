<?php
function types($filename) {

    $mime_types = array(

        // audio/video
        'mp3' => 'audio/mpeg',

    );
    global $path, $file;
    $ext = strtolower(array_pop(explode('.',$filename)));
    if (array_key_exists($ext, $mime_types)) {
        global $success_message;
        $success_message = "Файл ийгиликтүү жүктѳлдү!";
        move_uploaded_file($_FILES['filetoupload']['tmp_name'], "$path/$file");

    }
    else {
        global $error_message;
        $error_message = 'Бир гана mp3 форматтагы файлдарды жүктѳй аласыз!';
    }
}
?>
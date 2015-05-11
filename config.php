<?php
//error_reporting(E_ALL & ~(E_STRICT|E_NOTICE));
//ini_set('display_errors', '0');
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

header('Content-type: text/html; charset=UTF-8');

// host config
$db_host="localhost";
$db_user="root";
$db_pass="ulut123";
$db_name="pymusic";

/*
//  localhost config
    $db_host="localhost";
    $db_user="abakan";
    $db_pass="abakan";
    $db_name="pymusic";
 * */

define('SERVICE_FEE', 10);
define('SITE_TITLE', "ZakazPro");
define('SITE_ADDR', "ZakazPro");
define('SITE_ADMIN_TITLE', "ZakazPro");

define('PRINTER_BAR', "XP-80-1");
define('PRINTER_KITCHEN', "XP-80-2");

define('DB_PREFIX', "");
define('ROOT_PATH', dirname(__FILE__));

define("PHP_SELF",$_SERVER['PHP_SELF']);

date_default_timezone_set('Asia/Bishkek');
require_once ROOT_PATH."/class/classloader.php";
require_once ROOT_PATH."/class/mysql.class.php";
require_once ROOT_PATH."/class/functions.php";
$session = new Session;

$db=new db_mysql($db_host,$db_user,$db_pass,$db_name);
$db->connect();

$radio_names = array(	1=>"Миң Кыял FM",
						2=>"Кыргызстан Обондору",
						3=>"Тумар",
						4=>"Санжыра",
						5=>"Манас Жаңырыгы",
						6=>"Марал ФМ",
						7=>"Кыргыз Радиосу",
						8=>"OK радиосу"
						);

/*
$link = mysql_connect($db_host, $db_user, $db_pass);
if (!$link) {
    die('Ошибка соединения: ' . mysql_error());
}
echo 'Успешно соединились';
mysql_close($link);
*/
//mysql_query("SET NAMES 'utf8'");
//mysql_query("SET CHARACTER SET utf8");



// user_type = 1 => admin (супер-адам)
// user_type = 2 => operator (жумушчу-оператор)
// user_type = 3 => user(клиент-адам)
// user_type = 4 => company (клиент-ишкана)

?>
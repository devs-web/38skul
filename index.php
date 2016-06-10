<?
error_reporting(-1);
/* Кодировка */
set_time_limit(1);

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
   // echo 'Сервер работает под управлением Windows!';
} else {
    include("dbg.php");
}

date_default_timezone_set('Europe/Moscow');
session_start();

declare(ticks=1);
$tick = 0;

function tick_handler()
{
    global $tick;
    $tick++;
}
register_tick_function('tick_handler');


include ('core/core.php');

define('TICK',                 0); 
define('DOCUMENT_ROOT',        $_SERVER["DOCUMENT_ROOT"]); 
define("DEFAULT_MODULE",      "news"); // Модуль запускаемый по умолчанию, если запрашеваемый не найден, или другой не запрашивается
define("MODULE_DIR",          "modules"); // Директория с модулями
define("FILEMO_NAME",         "mo.php"); // Файл, открывающий модуль
define("COOKIE_TIME",         "2592000"); // Время хранения куки, в секундах.
define("MO_FILE",             "mo.php"); // Названия файлов модулей
define("EXTENSION_PHP",       "php"); // Исполняемые файлы
define("EXTENSION_TPL",       "tpl"); // Файлы шаблонов
define("STYLE_DIRECTORY",     DOCUMENT_ROOT . "/styles/"); // Директория дизайна
define("DEFAULT_STYLE",      "metro_new/"); // Директория дизайна
define("MODULES_DIRECTORY",   DOCUMENT_ROOT . "/modules/"); // Директория модулей
define("BLOCKS_DIRECTORY",    DOCUMENT_ROOT . "/blocks/"); // Директория дополнительных блоков
define("TEMPLATES_DIRECTORY", DOCUMENT_ROOT . "/templates/"); // Директория шаблонов

$dbs = array (
'site' => array( // Имя объекта, который будет использоваться для запросов в базу
 'host'     => '127.0.0.1', // Хост
 'port'     => '3306', // Порт
 'login'    => 'root', // Имя пользователя
 'password' => '', // Пароль
 'db'       => 'test_db', // Имя базы данных
 'charset'  => 'utf8' ), // Кодировка (лучше utf8)
 );

$main = new core($dbs);
echo $main->core->echo_html;
//echo $main->core->debug->GetDbgRam();

// function this private public var print parent if else switch case default continue break class 

//$main->core->autch->authorization('NarkoHeal', '25789');
//$main->core->session->deAutch ();

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
   // echo 'Сервер работает под управлением Windows!';
} else {

/*
echo "
<!-- Время генерации: ".(MicroTimeGen ()-$st)."
ЦП: ".getCpuUsage()." 
Тиков: $tick -->";*/
}

?>


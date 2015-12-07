<?php
//Старт сессии
session_start();
//Подключение к БД
$mysqli = new mysqli('localhost', 'root', '', 'HM');
//проверка нет ли ошибок при попытки соединения
if($mysqli->connect_error){
    printf('Ошибка подключения: '. $mysqli->connect_error);
    exit();
}
/** автозагрузка классов
 * @param $class_name
 */
function __autoload($class_name){
    $path = "../inc/class_{$class_name}.php";
    if(file_exists($path)){
        require_once($path);
    } elseif(file_exists($path="inc/class_{$class_name}.php")){
        require_once($path);
    } elseif(file_exists($path="class_{$class_name}.php")){
        require_once($path);
    } else {
        die ("Файл {$class_name}.php не найден.");
    }
}
?>
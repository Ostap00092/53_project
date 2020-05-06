<?php
//Подключение к базе данных
$mysql = new mysqli('localhost', 'root', '', 'group_chat');
//Проверка соединения
if($mysql->connect_error) {
    die("Соединение прервано: " . $mysql->connect_error);
}
?>
<?php
//Подключение к базе данных
$mysql = new mysqli('a333177.mysql.mchost.ru', 'a333177_root', 'zxcvzxcv', 'group_chat');
//Проверка соединения
if($mysql->connect_error) {
    die("Соединение прервано: " . $mysql->connect_error);
}
?>
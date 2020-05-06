<?php
//Импорт соединения
include("connect.php");
//Импорт данных
$title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
$pin = (int)$_POST['pin'];
$g = md5($title);
$h = md5($pin);
$_REQUEST;
$link = $_SERVER['QUERY_STRING'];
echo $link;
$mysql->query("INSERT INTO `groups` (`group_id`, `title`, `pin`, `link`) VALUES (NULL, '$title', '$pin', '$link')");
$mysql->close();
header("Location: ../index1.php");
?>
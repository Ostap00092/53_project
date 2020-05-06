<?php
//Импорт соединения
include("connect.php");
//Создаем массив для данных сообщений
$result = array();
//Импорт данных с очисткой от лишнего
$message  = $_POST['message'];
$username = $_POST['username'];
$group_id = $_POST['group_id'];
//Проверка сообщения
if(!empty($message) && !empty($group_id) && !empty($username)){
    //Запись в базу данных
    $sql = "INSERT INTO `messages` (`message`, `username`, `group_id`) VALUES 
    ('".$message."', '".$username."', $group_id)";
    $result['send_status'] = $mysql->query($sql);
}
//Получаем сообщения ИМЕННО для этой группы и отправляем их
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$com = "SELECT * FROM `messages` WHERE `id` > " . $start . " AND `group_id` = " . $group_id;
echo $com;
$items = $mysql->query($com);
while($row = $items->fetch_assoc()){
    $result['items'][] = $row;
}
//Закрытие соединения с базой данных
$mysql->close();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
    
echo json_encode($result);

?>
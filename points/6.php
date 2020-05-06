<?php
//Проверка в системе ли пользователь 
if ($_COOKIE['online'] != "1"){
    header("Location: autorize.html");
}
//Импорт подключения
include("../uploads/connect.php");
//Получаем все классы у которых есть наш id
$result = $mysql->query("SELECT `groups_id` FROM `users`");
$i = 0;
if($row = $result->fetch_assoc()){
    $id = $row;
}

$groups_id = $id[groups_id];
$array = unserialize($groups_id);
$res = $mysql->query('SELECT * FROM `groups` WHERE `group_id` IN (' . implode(',', array_map('intval', $array)) . ')');

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Группы</title>
</head>
<body>
    <?php while($num = $res->fetch_assoc()) :?>
    <form action="group.php" method="POST" class="group">
            <div class="group_header">
                <a><?=$num['title']?></a>
            </div>
            <div class="humans">
            <?php for($k = 1; $k <= 5; $k++):?>
                <div class="ava">
                    <img class="img_ava" src="images/user.png" alt="">
                </div>
            <?php endfor;?>
                <a href="" class="still">+5</a>
            </div>
            <div class="cont_join">
                <div class="join">
                    <input type="submit" value="Войти"  href="group.php">
                    </input>
                </div>
            </div>
            <input type="hidden" name="group_id" value="<?=$i?>">
            <input type="hidden" name="link" value="<?=$num['link']?>">
    </form>
            <?php endwhile;?>
    <div class="group">
            <a href="uploads/create.php"><img class="plus" src="images/+.png" alt=""></a>
            <a href="uploads/create.php" class="create">Создать</a>
    </div>
</body>
</html>
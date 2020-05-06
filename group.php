<?php
$group_id = intval($_POST['group_id']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" a href="css/group.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title>Группа номер <?php echo $group_id; ?></title>
    <script>
        //Создание переменных
        var username = null, 
            start    = 0, 
            group_id = <?echo $group_id?>,
            url      = "uploads/messages.php";
        //Проверка прогрузки страницы, если готово то запускается функция
        //Функция запуститься после полной прогрузки страницы
        $(document).ready(function() {
            //Импорт имени из куки
            username = "Вася Егоров";
            //Вызываем функцию прогрузки сообщений
            load();
            //При нажатии кнопки отправляем данные через метод POST
            $('form').submit(function(e) {
                $.post(url, {
                    //Переносим данные для отправки в их специальные ячейки
                //Импорт данных из блока с id message
                    message: String($('#message').val()),
                    //Имя и фамилия
                    username: username,
                    //id группы для сообщения
                    group_id: <?=$group_id?>
                });
                //После отправки стираем данные из поле отправки
                $('#message').val('');
                //Останавливаем функцию
                return false;
            });
        });
        //Функция прогрузки сообщений
        function load() {
            //Приём данных через метод GET
            $.get(url + '?start=' + start, function(result){
                if(result.items){
                    result.items.forEach(item=>{
                        start = item.id;
                        $('#messages').append(renderMessage(item));
                    });
                    $('#messages').animate({scrollTop: $('#messages')[0].scrollHeight});
                };
                //Вызываем её
                load();
            });
        }
        //Функция нписания сообщений(помещает сообщения в блоки html)
        function renderMessage(item) {
            let time = new Date(item.created);
            time = `${time.getHours()}:${time.getMinutes() < 10 ? '0' : ''}${time.getMinutes()}`;
            return `<div class="msg"><p>${item.username}</p>${item.message}<span>${time}</span></div>`;
        }
    </script>
</head>
<body>
    <div id="messages">

    </div>
    <form>
        <input name="message" id="message" type="text" placeholder="Пишите здесь"></input>
        <input type="submit" value="Отправить">
    </form>
</body>
</html>
<?php ## запись и фильтрация данных

    require_once ("../work_db/db.php");

    # Присваиваем текст и название из глобального массива POST
    $text = $_POST['text'];
    $title = $_POST['title'];

    # Время
    $date = time();

    # Пользователь ввел текст
    if(mb_strlen($text) <= 0){

        # Выход с ошибкой
        exit("Введите текст");
    }

    # Пользователь ввел название
    if(mb_strlen($title) <= 0){

        # Выход с ошибкой
        exit("Введите название");
    }

    # Создание нового экземпляра класса
    $db = new Db;

    # SQL-запрос для добавление текста с названием
    $query = "INSERT INTO `text` (`title`, `text`) VALUES ('$title','$text')";

    # Результат запроса в БД
    $result = $db->connect($query);

    # Результат парсинга текста
    $arr = $db->parser($text,"{","}");

    # Вывод значений id и secret_text из массива
    $secret_text = $arr[0];
    $id_text = $arr [1];

    # Есть ли секретный расчет
    if($secret_text != ""){

        # SQL-запрос в БД для записи секретного расчета и id текста
        $query = "INSERT INTO `secret_text` (`id_text`,`secret_text`) VALUES ('$id_text','$secret_text')";

        # Вызов функции для записи
        $db->connect($query);
    }

    # Переход на страницу ввода текста
    header('Location: input.html');

?>

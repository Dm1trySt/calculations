<?php ## запись и фильтрация данных

    require_once("../../model/text_processing/record_sql.php");

    # Присваение текста и названия из глобального массива POST
    $text = $_POST['text'];
    $title = $_POST['title'];

    # Экземпляр класса записи
    $record = new Record_sql;

    # Вызов функции для обработки и записи текста
    $record->processing($text,$title);

    # Переход на страницу ввода текста
    header('Location: ../../view/input_text/input.php');

?>

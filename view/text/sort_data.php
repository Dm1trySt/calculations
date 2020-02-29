<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Sort</title>

</head>
<body>
    <?php
        require_once("../work_db/db.php");



        #  SQL-запроса для получения значений таблицы secret_text
        $query_secret = "SELECT * FROM `secret_text`";

        # Создаем новый экземпляр класса
        $db = new Db;

        # Результат работы с функцией
        $sql_secret = $db->connect($query_secret);

        echo '<div>'.
            # Таблица с заголовками
            '<table border="1">'.
                '<thead>'.
                    # Заголовки
                    '<tr height="50" width="150">'.
                        '<th width="200">Дата </th>'.
                        '<th width="100">Название</th>'.
                        '<th width="400">Текст</th>'.
                        '<th width="400">Секретный текст</th>'.
                    '</tr>'.
                '</thead>'.
            '</table>'.
        '<div/>'.

        '<div style="width: auto; height: 550px; overflow: auto;">'.
            # Таблица с данными
            '<table border="1">'.
                '<tbody>';

                    # Перебор всех элементов массива таблицы secret_text
                    while($secret_text = $sql_secret->fetch_assoc()){

                        # Результат поиска подходящих по заданным условиям элементов
                        $result = $db->search($secret_text['secret_text'],$sign,$number);

                        # Найдены элементы удовлетворяющие условиям поиска
                        if ($result != NULL){

                            # SQL-запрос для поиска совпадений id (табл. text) с id_text (табл. secret_text)
                            $query_text = "SELECT * FROM `text` WHERE `id` = '$secret_text[id_text]'";

                            # Результат работы с БД
                            $sql_text = $db->connect($query_text);

                            # Результат сравнения значений id и id_text
                            $text = $sql_text->fetch_assoc();

                            # Вывод значений в таблицу
                            echo '<tr>'.
                                '<td width="200">' . $text['date'] . '</td>'.
                                '<td width="100">' . $text['title'] . '</td>'.
                                '<td width="400">' . $text['text'] . '</td>'.
                                '<td width="400">' .  $secret_text['secret_text'] . '</td>'.
                            '</tr>';
                        }

                    }
                echo '</tbody>'.
            '</table>'.
        '</div>';
    ?>

    <div>
        <form>
            <p>
                <!-- Кнопка для возврата к таблице со всеми данными-->
                <input type="button" value="Вернуться к просмотру всех данных"
                       onclick="location.href='data.php';">
            </p>
        </form>
    </div>
</body>
</html>
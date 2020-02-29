<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Sort</title>

</head>
<body>
    <?php
        require_once("../../model/text_processing/sort.php");

        # Проверка поля с числом
        if ($_POST['number']== NULL) {

            # Выход с ошибкой
            exit("Введите число");
        }

        # Число для сравнения
        $number = $_POST['number'];

        # Знак для сравнения
        $sign = $_POST['sign'];

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

                    # Экземпляр класса Sort
                    $sort = new Sort;

                    # Вывод отсортированной таблицы
                    $sort->data_sort($sign,$number);

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
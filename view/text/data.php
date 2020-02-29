<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Data</title>


</head>
<body>
    <?php

        require_once("../../model/text_processing/data.php");

        echo '<div >'.
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

         # Таблица с данными
        '<div style="width: auto;white-space: pre-wrap; height: 400px; overflow: auto;" >'.
            '<table border="1">'.
                '<tbody>';

                        # Экземпляр класса data
                        $data = new Data;

                        $data->table();



                        # Вывод значений в таблицу
                        echo '<tr>'.
                            '<td width="200">' . $text['date'] . '</td>'.
                            '<td width="100">' . $text['title'] . '</td>'.
                            '<td width="400">' . $text['text'] . '</td>'.
                           # '<td width="400">' . $secret_text . '</td>'.
                        '</tr>';

                echo '</tbody>'.
            '</table>'.
        '</div>';
    ?>

    <div>
        <form action='../../work_db/sort.php' method="post">

            <!-- Выбор сортировки -->
            <p> Выберите критерий сортировки и введите число:
                <select name="sign" id="sign">
                    <option value="1" >=</option>
                    <option value="2">></option>
                    <option value="3"><</option>
                </select>

                <!-- Поле ввода чисел для сортировки-->
                <input type = "text" name="number" id="number" size="auto" placeholder=" Введите число">

                <!-- Кнопки для сортировки и возврата-->
                <input type="submit" value="Сортировать" >
                <input type="button" value="Назад" onclick="location.href='input.html';">
            </p>
        </form>
    </div>
</body>
</html>
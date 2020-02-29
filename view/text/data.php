<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Data</title>


</head>
<body>
<?php
    require_once("../../model/db_connect/db.php");
    require_once("../../model/text_processing/conclusion_table.php");

    # Экземпляр класса Conclusion_table
    $conclusion_table = new Conclusion_table;
    echo '<div >'.
        # Таблица с заголовками
        '<table border="1">'.
            '<thead>'.
                 # Заголовки
                '<tr height="50" width="auto">'.
                    '<th width="200">Дата </th>'.
                    '<th width="118">Название</th>'.
                    '<th width="400">Текст</th>'.
                    '<th width="400">Секретный текст</th>'.
                '</tr>'.
            '</thead>'.
        '</table>'.
    '<div/>'.

    # Таблица с данными
    '<div  style="width: auto ;white-space: pre-wrap; height: 400px; overflow: auto;" >'.
        '<table border="1">'.
            '<tbody>';

                # Вывод отсортированной таблицы на экран
                $conclusion_table->conclusin();

            echo '</tbody>'.
        '</table>'.
    '</div>';
?>

<div>
    <form action='sort_data.php' method="post">

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
            <input type="button" value="Назад" onclick="location.href='../input_text/input.php';">
        </p>
    </form>
</div>
</body>
</html>

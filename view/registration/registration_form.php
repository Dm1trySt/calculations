<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
</head>
<body>
    <div>
        <form>
            <?php
                require_once("../../model/registration/user_table.php");

                # Таблица с заголовками
                echo '<table border="1">'.
                    '<thead>'.
                        # Заголовки
                        '<tr height="50" >'.
                            '<th width="200">Id </th>'.
                            '<th width="100">Login</th>'.
                            '<th width="320">Password</th>'.
                        '</tr>'.
                    '</thead>'.
                '</table>'.

                '<div style="width: auto; height: 200px; overflow: auto;">'.
                    # Таблица с данными
                    '<table border="1">'.
                        '<tbody>';

                            # Экземпляр класса User_table
                            $user_table = new User_table;

                            # Массив данных из БД
                            $arr = $user_table->output_table();

                            # Длинна массива
                            $long = count($arr);

                            # Вывод данных из массива на экран
                            for($i=0;$i<$long;$i++){

                                # Вывод значений на страницу
                                echo '<tr>'.
                                    '<td width="200">' . $arr[$i] . '</td>'.
                                    '<td width="100">' . $arr[++$i] . '</td>'.
                                    '<td width="320">' . $arr[++$i] . '</td>'.
                                '</tr>';
                            }
                        echo '</tbody>'.
                    '</table>'.
                '</div>';
            ?>
        </form>
    </div>

    <div>
        <form action="../../controller/authorization/registration.php" method="post">

            <!-- Формы для ввода данных-->
            <p>
                id: <input type = "text" name="user_id" id="user_id" placeholder="Введите id" size ="5">
                login: <input type = "text" name="login" id="login" placeholder="Введите логин" size ="25">
                password: <input type = "text" name="password" id="password" placeholder="Введите пароль">
            </p>

            <!--Кнопки управления-->
            <p>Выберите из списка:
                <select name="action" id="action">
                    <option value="1" >Добавить пользователя</option>
                    <option value="2">Удалить пользователя</option>
                    <option value="3">Изменить данные пользователя</option>
                </select>
                <input type="submit" value="Выполнить" size=auto>
            </p>
            <p>
                <!--Кнопка для возврата на страницу ввода текста-->
                <input type="button" value="Назад" size ="50"
                        onclick="location.href='../input_text/input.php';">

                <!--Кнопка для просмотра информации-->
                <input type="button" value="Информация по использованию" onclick="location.href='info.html';">
            </p>
        </form>
    </div>
</body>
</html>
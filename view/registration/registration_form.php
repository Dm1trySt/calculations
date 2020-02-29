<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
</head>
<body>
        <div>
            <form >
                <?php
                    require_once("../work_db/db.php");

                    # Создаем новый экземпляр класса
                    $db = new Db;

                    # SQL-запрос для получения содержиомго таблицы users
                    $query = "SELECT * FROM `users` ";

                    # Результат работы с функцией
                    $sql = $db->connect($query);

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

                                # Перебор всех элементов массива таблицы users
                                while($user = $sql->fetch_assoc()){

                                    # Вывод значений в таблицу
                                    echo '<tr>'.
                                        '<td width="200">' . $user['id'] . '</td>'.
                                        '<td width="100">' . $user['input'] . '</td>'.
                                        '<td width="320">' . $user['password'] . '</td>'.
                                    '</tr>';
                                }
                            echo '</tbody>'.
                        '</table>'.
                    '</div>';
                ?>
            </form>
        </div>

        <div>
            <form action="registration.php" method="post">

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
                           onclick="location.href='../view/input_text/input_admin.html';">

                    <!--Кнопка для просмотра информации-->
                    <input type="button" value="Информация по использованию" onclick="location.href='info.html';">
                </p>
            </form>
        </div>
</body>
</html>
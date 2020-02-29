<?php

    require_once("../../model/db_connect/db.php");

    class User_table extends Db{

        # Вывод таблицы пользователей
        public function output_table(){

            # SQL-запрос для получение данных таблицы users
            $sql = $this->sql_query("SELECT * FROM `users` ");

            # Перебор всех элементов массива таблицы users
            while($user = $sql->fetch(PDO::FETCH_ASSOC)){

                # Вывод значений на страницу
                echo '<tr>'.
                    '<td width="200">' . $user['id'] . '</td>'.
                    '<td width="100">' . $user['login'] . '</td>'.
                    '<td width="320">' . $user['password'] . '</td>'.
                '</tr>';
            }
        }
    }




?>

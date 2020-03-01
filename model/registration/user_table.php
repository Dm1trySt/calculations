<?php

require_once("../../model/db_connect/db.php");

class User_table extends Db{

    # Вывод таблицы пользователей
    public function output_table(){

        # SQL-запрос для получение данных таблицы users
        $sql = $this->sql_query("SELECT * FROM `users` ");

        # Перебор всех элементов массива таблицы users
        while($user = $sql->fetch(PDO::FETCH_ASSOC)){

            # Массив данных из БД
            $result[]=$user['id'];
            $result[]=$user['login'];
            $result[]=$user['password'];

        }

        return $result;
    }
}


?>
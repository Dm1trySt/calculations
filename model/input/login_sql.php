
<?php ## Проверка логина и пароля

require_once("../../model/db_connect/db.php");

    class Select_login extends Db {

        # Авторизация пользователя
        function authorization($usr_login,$usr_password){

            # Хэширование пароля
            $usr_password = md5($usr_password."tutsol135");

            # SQl-запрос для сравнения введнных данных с данными в БД
            $sql = "SELECT * FROM `users` WHERE `login` = :usr_login AND `password` = :usr_password";


            # Ассоциативный  массив для хранения данных и подстановки их в SQL-запрос
            $params = [
                ':usr_login' => $usr_login,
                ':usr_password' => $usr_password
            ];

            # Отправка SQL-запроса в БД
            $sql=$this->sql_query_param($sql,$params);

            # Переводим данные из формата БД в массив
            $result = $sql->fetch(PDO::FETCH_ASSOC);

            # Если в массиве 0 элементов - пользователя с такими же данными в БД нет
            if ( $result == NULL) {

                # Выход с ошибкой
                exit("Такого пользователя не существует!");
            }

            return $result;
        }
    }
?>

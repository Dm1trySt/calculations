
<?php ## Проверка логина и пароля

require_once("../../model/db_connect/db.php");

    class Select_login extends Db {

        function authorization($usr_login,$usr_password){

            # Хэширование пароля
            $usr_password = md5($usr_password."tutsol135");

            # Создаем новый экземпляр класса
           $sql = $this->connect("SELECT * FROM `users` WHERE `login` = '$usr_login' AND `password` = '$usr_password'");

            # Переводим данные из формата БД в массив
            $result = $sql->fetch_assoc();

            # Если в массиве 0 элементов - пользователя с подходящими логином и паролем в БД нет
            if ( $result === NULL) {

                # Выход с ошибкой
                exit("Такого пользователя не существует!");
            }
        }
    }
?>

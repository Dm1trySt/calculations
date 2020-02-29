<?php

    require_once("../../model/db_connect/db.php");

    class User_profile extends Db{

        # Содержимое таблицы users
        public function sql_user(){

            #Подключение к БД
            $db =  $this->pdo();

            # SQL-запрос для получения таблицы пользователей
            return $db->query("SELECT * FROM `users`");

        }

       # Добавление пользователя
        public function add_user($usr_password,$usr_login ){

            # Содержимое таблицы users
            $sql_usr = $this->sql_user();

            # Поля логин и пароль не должны быть пустыми
            if (($usr_password == NULL) || ($usr_login == NULL)) {

                # Выход с ошибкой
                exit("Поля логин и пароль не могут быть пустыми");
            }

            # Хэширование пароля
            $usr_password = md5($usr_password . "tutsol135");

            # Перебор всех элементов массива
            while ($result_login = $sql_usr->fetch(PDO::FETCH_ASSOC)) {

                # Проверка на совпадение логина из БД и введенного логина
                if ($result_login['login'] == $usr_login) {

                    # Выход с ошибкой
                    exit("Логины не должны совпадать");
                }
            }

            # SQL-запрос для добавления пользователя
            $sql = "INSERT INTO `users` (`login`,`password`) VALUES (:usr_login,:usr_password)";

            # Ассоциативный  массив для хранения данных и подстановки их в SQL-запрос
            $params = [
                ':usr_login' => $usr_login,
                ':usr_password' => $usr_password
            ];

            # Отправка SQL-запроса в БД
            $this->sql_query_param($sql,$params);

            # Возвращение к странице регистрации
            return header('Location: ../../view/registration/registration_form.php');
        }

        # Удаление пользователя
        public function delete_user($usr_login,$usr_id){

            # Содержимое таблицы users
            $sql_usr = $this->sql_user();

            # Перебор всех элементов массива
            while ($result_login = $sql_usr->fetch(PDO::FETCH_ASSOC)){

                # Проверка на совпадение логина из БД и введенного логина
                if($result_login['login']==$usr_login){

                    # Попытка удалить администратора по логину
                    if($usr_login == "Admin") {

                        # Выход с ошибкой
                        exit("Нельзя удалить администратора");
                    }

                    # SQL-запрос для удаления пользователя по логину
                    $sql = "DELETE FROM `users` WHERE `login` = :usr_login";

                    # Ассоциативный  массив для хранения данных и подстановки их в SQL-запрос
                    $params = [':usr_login' => $usr_login];

                    # Отправка SQL-запроса в БД
                    $this->sql_query_param($sql,$params);

                    # Возвращение к странице регистрации
                    return header('Location: ../../view/registration/registration_form.php');

                 # Проверка на наличие введенного id в БД
                }elseif ($result_login['id']==$usr_id){

                    # Попытка удалить администратора по id
                    if($usr_id == "1"){

                        # Выход с ошибкой
                        exit("Нельзя удалить администратора");
                    }

                    # SQL-запрос для удаления пользователя по id
                    $sql = "DELETE FROM `users` WHERE `id` = :usr_id";

                    # Ассоциативный  массив для хранения данных и подстановки их в SQL-запрос
                    $params = [':usr_id' => $usr_id];

                    # Отправка SQL-запроса в БД
                    $this->sql_query_param($sql,$params);

                    # Возвращение к странице регистрации
                   return header('Location: ../../view/registration/registration_form.php');
                }
            }

            # Выход с ошибкой
            exit("Введенны некорректные данные");
        }

        # Изменение информации пользователя
        public function edit_user($usr_password,$usr_login,$usr_id){

            # Содержимое таблицы users
            $sql_usr = $this->sql_user();

            # Перебор всех элементов массива
            while ($result_login = $sql_usr->fetch(PDO::FETCH_ASSOC)){

                # Введенный id есть в БД
                if ($result_login['id'] == $usr_id){

                    # Если пользователь ввел логин и не пытается изменить логин администратора
                    if (($usr_login != NULL)&&($result_login['id'] != "1")){

                        # SQL- запрос для изменения логина пользователя
                        $sql = "UPDATE `users` SET `login` = :usr_login  WHERE `id` = :usr_id";

                        # Ассоциативный  массив для хранения данных и подстановки их в SQL-запрос
                        $params = [
                            ':usr_login' => $usr_login,
                            ':usr_id' => $usr_id
                            ];

                        # Отправка SQL-запроса в БД
                        $this->sql_query_param($sql,$params);

                        # Возвращение к странице регистрации
                        return header('Location: ../../view/registration/registration_form.php');
                    }

                    # Изменить пароль пользователя
                    if ($usr_password != NULL){

                        # Хэширование пароля
                        $usr_password = md5($usr_password."tutsol135");

                        # SQL- запрос для изменения пароля пользователя
                        $sql = "UPDATE `users` SET `password` = :usr_password WHERE `id` = :usr_id";

                        # Ассоциативный  массив для хранения данных и подстановки их в SQL-запрос
                        $params = [
                            ':usr_password' => $usr_password,
                            ':usr_id' => $usr_id
                        ];

                        # Отправка SQL-запроса в БД
                        $this->sql_query_param($sql,$params);

                        # Возвращение к странице регистрации
                        return header('Location: ../../view/registration/registration_form.php');
                    }

                    # Выход с ошибкой
                    exit("Введены некорректные данные");
                }
            }

            # Выход с ошибкой
            exit("Введен неверный id");
        }
    }
?>

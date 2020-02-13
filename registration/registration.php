<?php
    require_once ("../work_db/db.php");

    # filter_var - принимает строку, которую необходимо отфильтровать
    # FILTER_SANITIZE_STRING - убирает все теги и спец. символы
    # trim - удаляет пробелы из начала строки
    $usr_login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);

    # Пароль пользователя
    $usr_password = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);

    # Id Пользователя
    $usr_id = filter_var(trim($_POST['user_id']),FILTER_SANITIZE_STRING);

    # Выбранное пользователем действие для работы с БД
    $action = $_POST['action'];

    # Новый экземпляр класса
    $db = new Db;

    # Содержимое таблицы users
    $query_login = "SELECT * FROM `users`";

    # Результат SQL-запроса
    $sql_usr = $db ->connect($query_login);

    # Добавление пользователя
    if($action == "1"){

        # Перевод данных из формата БД в массив
        if(($usr_password == NULL)||($usr_login == NULL)) {

            # Выход с ошибкой
            exit("Поля логин и пароль не могут быть пустыми");
        }

        # Хэширование пароля
        $usr_password = md5($usr_password."tutsol135");

        # Перебор всех элементов массива
        while ($result_login = $sql_usr->fetch_assoc()){

            # Проверка на совпадение логина из БД и введенного логина
            if ($result_login['login'] == $usr_login){

                # Выход с ошибкой
                exit("Логины не должны совпадать");
            }
        }

        # SQL-запрос для добавления пользователя
        $query = "INSERT INTO `users` (`login`,`password`) VALUES ('$usr_login','$usr_password')";

        # Вызов функции для отправки SQL-запроса  в БД
        $db->connect($query);

        # Переход на страницу регистрации
        header('Location: registration_form.php');


    # Удаление пользователя
    }elseif ($action == "2"){

        # Перебор всех элементов массива
        while ($result_login = $sql_usr->fetch_assoc()){

            # Проверка на совпадение логина из БД и введенного логина
            if($result_login['login']==$usr_login){

                # Попытка удалить администратора по логину
                if($usr_login == "Admin") {

                    # Выход с ошибкой
                    exit("Нельзя удалить администратора");
                }

                # SQL-запрос для удаления пользователя
                $query_delete = "DELETE FROM `users` WHERE `login` = '$usr_login'";

                # Вызов функции для отправки SQL-запроса
                $db->connect($query_delete);

                # Переход на страницу регистрации
                header('Location: registration_form.php');

            }
            # Проверка на наличие введенного id в БД
            elseif ($result_login['id']==$usr_id){

                # Попытка удалить администратора по id
                if($usr_id == "1"){

                    # Выход с ошибкой
                    exit("Нельзя удалить администратора");
                }

                # SQL-запрос для удаления пользователя
                $query_delete = "DELETE FROM `users` WHERE `id` = '$usr_id'";

                # Вызов функции для отправки SQL-запроса
                $db->connect($query_delete);

                # Переход на страницу регистрации
                header('Location: registration_form.php');
            }
        }

       # Выход с ошибкой
       exit("Введенный логин не существует");

    # Изменение информации пользователя
    }else{

        # Перебор всех элементов массива
        while ($result_login = $sql_usr->fetch_assoc()){

            # Введенный id есть в БД
            if ($result_login['id'] == $usr_id){

                # Если пользователь ввел логин и не пытается изменить логин администратора
                if (($usr_login != NULL)&&($result_login['id'] != "1")){

                    # SQL-запрос для изменения логина пользователя
                    $query_transform = "UPDATE `users` SET `login` = '$usr_login'  WHERE `id` = '$usr_id'";

                    # Вызов функции для отправки SQL-запроса
                    $db->connect($query_transform);

                    # Переход на страницу регистрации
                    header('Location: registration_form.php');
                }

                # Изменить пароль пользователя
                if ($usr_password != NULL){

                    # Хэширование пароля
                    $usr_password = md5($usr_password."tutsol135");

                    # SQL-запрос для замены пароля пользователя
                    $query_transform = "UPDATE `users` SET `password` = '$usr_password' WHERE `id` = '$usr_id'";

                    # Вызов функции для отправки SQL-запроса
                    $db->connect($query_transform);

                    # Переход на страницу регистрации
                    header('Location: registration_form.php');
                }
            }
        }

        # Выход с ошибкой
        exit("Введен неверный id");
    }

    # Переход на страницу регистрации
    header('Location: registration_form.php');
?>
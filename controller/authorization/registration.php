<?php

    require_once("../../model/registration/user_profile.php");

    # filter_var - принимает строку, которую необходимо отфильтровать
    # FILTER_SANITIZE_STRING - убирает все теги и спец. символы
    # trim - удаляет пробелы из начала строки
    # Логин пользователя
    $usr_login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);

    # Пароль пользователя
    $usr_password = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);

    # Id Пользователя
    $usr_id = filter_var(trim($_POST['user_id']),FILTER_SANITIZE_STRING);

    # Выбранное пользователем действие для работы с БД
    $action = $_POST['action'];

    # Экземпляр класса User_profile
    $usr_profile = new User_profile;

    # Выбран пункт "Добавить пользователя"
    if($action == "1"){

        # Добавление пользователя
        $usr_profile->add_user($usr_password,$usr_login);

    # Выбран пункт "Удалить пользователя"
    }elseif ($action == "2"){

        # Удаление пользователя
        $usr_profile->delete_user($usr_login,$usr_id);

    # Выбран пункт "Изменить данные пользователя"
    } else{

        # Изменение данных пользователя
        $usr_profile->edit_user($usr_password,$usr_login,$usr_id);
    }

?>
<?php
    require_once("../../model/input/login_sql.php");

    # filter_var - принимает строку, которую необходимо отфильтровать
    # FILTER_SANITIZE_STRING - убирает все теги и спец. символы
    # trim - удаляет пробелы из начала строки
    # Фльтр для логина
    $usr_login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);

    # Фльтр для пароля
    $usr_password = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);

    # Создание экземпляра класса
    $select_login = new Select_login;

    # Вызов функции для проверки пользователя
    $result = $select_login->authorization($usr_login,$usr_password);

    # Создание сессии
    session_start();

    # Присваиваем сессии логин пользователя
    $_SESSION['login'] = $result['login'];

    # Время жизни сессии 24 часа
    ini_set('session.gc_maxlifetime', 3600*24);

    # Переход на страницу записи текста
    header('Location: ../../view/input_text/input.php');

?>

<?php ## Проверка логина и пароля

    require_once ("../work_db/db.php");

    # filter_var - принимает строку, которую необходимо отфильтровать
    # FILTER_SANITIZE_STRING - убирает все теги и спец. символы
    # trim - удаляет пробелы из начала строки
    $usr_login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);

    # Фльтр для пароля
    $usr_password = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);

    # Хэширование пароля
    $usr_password = md5($usr_password."tutsol135");

    # Создаем новый экземпляр класса
    $db = new Db;

    # Запрос для БД
    $query = "SELECT * FROM `users` WHERE `login` = '$usr_login' AND `password` = '$usr_password'";

    # результат работы с функцией
    $sql = $db ->connect($query);

    # Переводим данные из формата БД в массив
    $result = $sql->fetch_assoc();



    # Если в массиве 0 элементов - пользователя с подходящими логином и паролем в БД нет
    if ( $result === NULL) {

        # Выход с ошибкой
        exit("Такого пользователя не существует!");
    }

    # id пользователя
    $user_id = $result['id'];

    # Вход с администратора
    if ($result['login'] == 'Admin'){

        # Переход на страницу текста для администратора
        exit(header('Location: ../text_processing/input_admin.html'));
    }

    # Переход на страницу записи текста
    header('Location: ../text_processing/input.html');
?>

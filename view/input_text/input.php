<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Calculations</title>

</head>
<body>
    <div class="title">
        <form action="../../controller/text/record_admin.php" method="post">
            <!--поле ввода названия-->
            <p>Название: <input type = "text" name="title" id="title" size="42"
                                placeholder="Введите название">
            </p>

            <!--поле ввода текста-->
            <p>Текст:<br>

                <textarea type ="text" name="text" id="text" style="margin: 0px; height: 282px; width: 425px;"
                          placeholder="Введите текст"></textarea>
            </p>

            <!--кнопки управления формой-->
            <p>
                <input type="submit" value="Сохранить">
                <input type="reset" value="Очистить">
                <input type="button" value="Вывод данных" onclick="location.href='../text/data_admin.php';">

                <!-- Вход выполнен с администратора? -->
                <?php session_start(); if ($_SESSION['login']=="Admin"):?>
                    <input type="button" value="Регистрация"
                        onclick="location.href='../registration/registration_form.php';">
                <?php endif; ?>
            </p>

            <!--Выход-->
            <p>
                <input  type="button" value="Выход" onclick="location.href='../../index.php';">
            </p>
        </form>
    </div>
</body>
</html>
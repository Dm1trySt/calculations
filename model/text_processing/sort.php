<?php

    require_once("../../model/db_connect/db.php");
    require_once("../../model/registration/search.php");

    class Sort extends Db{

        # Сортировка данных
        public function data_sort($sign,$number){

            #  SQL-запроса для получения значений таблицы secret_text
            $sql_secret = $this->sql_query("SELECT * FROM `secret_text`");

            # Перебор всех элементов массива
            while($secret_text = $sql_secret->fetch(PDO::FETCH_ASSOC)){

                # Результат поиска подходящих по заданным условиям элементов
                $result = search($secret_text['secret_text'],$sign,$number);

                # Найдены элементы удовлетворяющие условиям поиска
                if ($result != NULL){

                    # SQL-запрос для поиска совпадений id (табл. text) с id_text (табл. secret_text)
                    $sql_text ="SELECT * FROM `text` WHERE `id` = :id_text";

                    # Ассоциативный  массив для хранения данных и подстановки их в SQL-запрос
                    $params = [':id_text' => $secret_text['id_text']];

                    # Отправка SQL-запроса в БД
                    $sql_text= $this->sql_query_param($sql_text,$params);

                    # Результат сравнения значений id и id_text
                    $text = $sql_text->fetch(PDO::FETCH_ASSOC);

                    # Вывод значений на страницу
                    echo '<tr>'.
                        '<td width="200">' . $text['date'] . '</td>'.
                        '<td width="100">' . $text['title'] . '</td>'.
                        '<td width="400">' . $text['text'] . '</td>'.
                        '<td width="400">' .  $secret_text['secret_text'] . '</td>'.
                    '</tr>';

                }

            }
        }
    }
?>

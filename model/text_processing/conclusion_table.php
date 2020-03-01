<?php

require_once("../../model/db_connect/db.php");
require_once("check.php");

class Conclusion_table extends Db{

    # Вывод таблицы с данными
    public function conclusin(){

        # SQL-запрос для получения содержиомго таблицы text
        $sql =$this->sql_query("SELECT * FROM `text` ");

        # Перебор всех элементов массива таблицы text
        while($text = $sql->fetch(PDO::FETCH_ASSOC)){

            # SQL-запрос для поиска совпадений id_text(табл. secret_text) с id (табл. text)
            $sql_secret = "SELECT * FROM `secret_text` WHERE `id_text` = :text_id";

            # Ассоциативный  массив для хранения данных и подстановки их в SQL-запрос
            $params = [':text_id' => $text['id']];

            # Отправка SQL-запроса в БД
            $sql_secret = $this->sql_query_param($sql_secret,$params);

            # Перевод данных из формата БД в массив
            $arr= $sql_secret->fetch(PDO::FETCH_ASSOC);

            # Результат сравнения значений id и id_text
            $secret_text = check($arr);

            # Массив данных из БД
            $result[] = $text['date'];
            $result[] = $text['title'];
            $result[] = $text['text'];
            $result[] = $secret_text;
        }

        return $result;
    }
}

?>
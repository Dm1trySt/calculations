<?php
    require_once("../../model/db_connect/db.php");
    require_once("parser.php");

    class Record_sql extends Db {

        # Запись в БД
        public function processing($text, $title){

            # Пользователь не ввел текст
            if(mb_strlen($text) <= 0){

                # Выход с ошибкой
                exit("Введите текст");
            }

            # Пользователь не ввел название
            if(mb_strlen($title) <= 0){

                # Выход с ошибкой
                exit("Введите название");
            }

            # SQL-запрос для добавление текста с названием
            $sql = "INSERT INTO `text` (`title`, `text`) VALUES (:usr_title,:usr_text)";

            # Ассоциативный  массив для хранения данных и подстановки их в SQL-запрос
            $params = [
                ':usr_title' => $title,
                ':usr_text' => $text
            ];

            # id записи
            $id_text = $this->id_params($sql,$params);

            # Экземпляр класса парсер
            $parser = new Parser;

            # Результат парсинга текста
            $secret_text  = $parser->parsing_text($text,"{","}");

            # Есть ли секретный расчет
            if($secret_text != ""){

                # SQL-запрос в БД для записи секретного расчета и id текста
                $sql_secret = "INSERT INTO `secret_text` (`id_text`,`secret_text`) VALUES (:id_text,:secret_text)";

                # Ассоциативный  массив для хранения данных и подстановки их в SQL-запрос
                $params = [
                    ':id_text' => $id_text,
                    ':secret_text' => $secret_text
                ];

                # Отправка SQL-запроса в БД
                $this->sql_query_param($sql_secret,$params);
            }
        }
    }
?>

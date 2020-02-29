<?php
    class Db{

        # Контейнер для id записи
        public $id;

        # Подключение к БД
        public function pdo(){

            # Данные для соединения с БД при помощи PDO
            $driver = 'mysql';
            $host = 'localhost';
            $name_db = 'db';
            $user_db = 'root';
            $password_db = '';
            $charset = 'utf8';

            # ATTR_ERRMODE -режим сообщений об ошибках
            $options = [PDO::ATTR_ERRMODE];

            # Проверка на успешное соединение с БД
            try {

                # PDO - устанавливает соединения с БД
                $pdo = new PDO("$driver:host=$host;dbname=$name_db;charset=$charset",$user_db,$password_db,$options);

                # Если есть ошибка отслеживаем PDOException
                # $err - информация об ошибке
            }catch (PDOException $err){
                die("Ошибка при попытке подключения к базе данных");
            }

            return $pdo;
        }

        # SQL-запрос в БД
        public function sql_query($sql){

            # Подключение к БД
            $db = $this->pdo();

            # SQL-запрос в БД
            $sql = $db->query($sql);

            return $sql;
        }

        # SQL-запрос в БД c параметрами
        public function sql_query_param($sql, $params){

            # Подключение к БД
            $db = $this->pdo();

            # prepare - подготовка запроса к выполнению
            $sql = $db->prepare($sql);

            # execute - запускает подготовленный запрос на выполнение
            $sql->execute($params);

            # id текущей записи
            $this->id = $db->lastInsertId('id');

            return $sql;
        }

        # id записи
        public function id_params($sql,$params){

            # Отправка SQL-запроса в БД
            $this->sql_query_param($sql,$params);

            # id записи
            return $this->id;
        }
    }
?>

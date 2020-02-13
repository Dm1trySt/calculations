<?php
class Db{

    # Для id записи
    private $id;

    # Подключение к БД и запрос
    public function connect($str){

        # mysqli - устанавливает соединения с БД
        $db = new mysqli('localhost','root','','db');

        # Проверка на успешное соединение с БД
        if ($db->connect_errno){

            # Выход с ошибкой
            exit("Не удалось подключиться к БД:" . $db->connect_errno );
        }

        # Запрос в БД
        $sql = $db->query($str);

        # id текущей записи
        $this->id = $db->insert_id;

        # Выход из БД
        $db->close();

        return $sql;
    }

    # Поиск подходящих значений
    public function search($text,$sign,$number){

        # Контейнер для положительного или отрицательного ответа
        $presence = NULL;

        # Проверка на равенство
        if($sign == "1") {

            # explode - преобразует строки в массив данных
            $arr = explode(',',$text);

            # Перебор массива
            foreach ($arr as $value){

                # Преобразование строки $value в число
                $value = (int)$value;

                # Если значение равно числу - подходящее значение
                if ($value == $number){

                    # Контейнер = 1 т.к. найдено подходящее значние
                    $presence = 1;
                }
            }

            # Значение больше заданного числа
        }elseif ($sign == "2"){

            # Преобразование строки $number в число
            $number =(int)$number;

            # Преобразование строк в массив данных
            $arr = explode(',',$text);

            # Перебор массива
            foreach ($arr as $value){

                # Преобразование строки $value в число
                $value = (int)$value;

                # Если значение больше числа - подходящее значение
                if ($value > $number){

                    # Контейнер = 1 т.к. найдено подходящее значние
                    $presence = 1;
                }
            }

            # Значение меньше заданного числа
        }else{

            # Преобразование строки $number в число
            $number =(int)$number;

            # Преобразование строк в массив данных
            $arr = explode(',',$text);

            # Перебор массива
            foreach ($arr as $value){

                # Преобразование строки $value в число
                $value = (int)$value;

                # Если значение меньше числа - подходящее значение
                if ($value < $number){

                    # Контейнер = 1 т.к. найдено подходящее значние
                    $presence = 1;
                }
            }
        }

        # Были подходящие значения
        if ($presence == NULL)
            return $result = NULL;
        else
            return $result = $text;
    }

    # Поиск секретного расчета
    public function parser($text, $z1, $z2){

        # Массив из строк
        #explode - преобразует строки в массив данных
        $t_arr= explode(" ", $text);

        # Контейнер для хранения подходящих значений
        $secret_text = "";

        # Перебор всех элементов массива
        foreach ($t_arr as $value){

            # Поиск по заданным параметрам порядковый номер походящего символа
            # strpos — возвращает позицию первого вхождения искомого элемента
            $line_number = strpos($value, $z1);

            # substr - возваращает часть строки
            $start_str = substr($value, $line_number);

            # strip_tags - очищает строку от HTML тегов
            # Поиск окончания строки
            $str =  strip_tags(substr($start_str,0, strpos($start_str, $z2)));

            # Есть ли в начале строки "{"
            if (substr($str, 0, 1) == "{"){

                # Вывод строки будет после символа {
                $str = substr($str,1);

                # В строке есть число
                if (is_numeric($str)){

                    # Перевод строки в формат float
                    $str =(float)$str;

                    # floor - округляет дробь в меньшую сторону
                    # Это число целое
                    if ($str - floor($str) == 0){

                        # Перевод числа в формат int
                        $str =(int)$str;

                        # Добавление подходящих значений
                        $secret_text .= $str.", ";
                    }
                }
            }
        }

        # Удаление последних двух элементов строки
        $secret_text= substr($secret_text,0,-2);

        # id записи
        $id = $this->id;

        # Запись секретного текста и id текста в массив
        $result = [$secret_text, $id];

        return $result;
    }

    # Сравнение значений
    public function check ($sql){

        # Перевод данных из формата БД в массив
        $arr= $sql->fetch_assoc();

        # Контейнер для результатов
        $result = "";

        # Если совпадений нет - пустой результат
        if ($arr != NULL){

            # Серкетный текст из массива
            $result = $arr['secret_text'] ;
        }

        return $result;
    }
}
?>

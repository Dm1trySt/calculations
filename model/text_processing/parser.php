<?php

    require_once("../../model/db_connect/db.php");
    class Parser extends Db{

        # Поиск секретного расчета
        public function parsing_text($text, $z1, $z2){

            # Массив из строк
            # explode - преобразует строки в массив данных
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

            return $secret_text;
        }

    }

?>

<?php

    # Сравнение значений id и id_text
    function check ($arr){

        # Контейнер для результатов
        $result = "";

        # Если совпадений нет - пустой результат
        if ($arr != NULL){

            # Серкетный текст из массива
            $result = $arr['secret_text'] ;
        }

        return $result;
    }
?>

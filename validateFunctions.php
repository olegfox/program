<?php

/**
 * Функция для проверки корректности расставленных фигурных скобок в php файле
 *
 * @param $file
 * @return bool
 */
function validate($file)
{
    $text = file_get_contents($file['tmp_name']);
    if ($text) {
        $para = array(
            '{' => '}'
        );

        $para = array_flip($para);
        $stack = array();
        $stack_size = 0;

        for ($i = 0; $i < strlen($text); $i++) {
            if (in_array($text{$i}, array_values($para))) {
                $stack[$stack_size++] = $text{$i};
            } else if (in_array($text{$i}, array_keys($para))) {
                $last = $stack_size ? $stack[$stack_size - 1] : '';
                if ($last != $para[$text{$i}]) {
                    return false;
                } else {
                    unset($stack[--$stack_size]);
                }
            }
        }

        if (count($stack) == 0) {
            echo 'Скобки расставлены верно';
        } else {
            echo 'Скобки расставлены неверно';
        }
    } else {
        echo "Ошибка при открытии файла";
    };
}

/**
 * Функция для получения mime-type файла
 *
 * @param $file
 * @return mixed
 */
function getMimeType($file){
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType =  finfo_file($finfo, $file);
    finfo_close($finfo);

    return $mimeType;
}
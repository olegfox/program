<?php

require_once("validateFunctions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['file']['name'])) {
        if(getMimeType($_FILES['file']['tmp_name']) == 'text/x-php'){
            validate($_FILES['file']);
        } else{
            echo 'Вы выбрали не php файл';
        }
    }
}


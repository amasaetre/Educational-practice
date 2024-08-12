<?php

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    exit(0);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];


    if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $filePath = '../data/form_data.txt';


        $data = "Имя: $name, Email: $email" . PHP_EOL;


        file_put_contents($filePath, $data, FILE_APPEND | LOCK_EX);


        echo json_encode(["status" => "success", "message" => "Данные успешно отправлены"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Неверные данные"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Неверный метод отправки"]);
}

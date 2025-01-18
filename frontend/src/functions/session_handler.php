<?php

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userId = $_POST['userId'] ?? null;
    $token = $_POST['token'] ?? null;

    if($userId && $token){
        $_SESSION['userId'] = $userId;
        $_SESSION['token'] = $token;
        echo json_encode(["message" => "success"]);
    } else {
        echo json_encode(["message" => "error"]);
    }
    exit;
}

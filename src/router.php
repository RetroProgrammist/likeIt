<?php
include 'vendor/autoload.php';

try {
    if(!isset($_GET['action'])) {
        throw new \InvalidArgumentException('{"error":"Action не определен"}');//404
    }

    $controller = \Rzhanau\Main\Router::GetController($_GET['action']);

    $answer = $controller->run($_POST);

    echo $answer;
} catch (\Throwable $e) {
    echo sprintf('{"error":"%s"}', $e->getMessage());
}
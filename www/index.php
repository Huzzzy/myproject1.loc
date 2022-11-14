<?php

spl_autoload_register(function (string $className) {
    require_once '../src/' . str_replace('\\', '/', $className) . '.php';
});

$route = $_GET['route'] ?? '';

$pattern = '~^hello/(.*)$~';
preg_match($pattern, $route, $matches);

if (!empty($matches)) {
    $controller = new \MyProject\Controllers\MainController();
    $controller->sayHello($matches[1]);
    return;
}

$pattern = '~^$~';
preg_match($pattern, $route, $matches);

if (!empty($matches)) {
    $controller = new \MyProject\Controllers\MainController();
    $controller->main();
    return;
}

echo 'Страница не найдена';
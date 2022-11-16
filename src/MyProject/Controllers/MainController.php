<?php

namespace MyProject\Controllers;

class MainController
{
    public function main()
    {
        $articles = [
            ['name' => 'Статья 1', 'text' => 'Текст статьи 1'],
            ['name' => 'Статья 2', 'text' => 'Текст статьи 2'],
        ];
        require __DIR__ . '/../../../templates/main/main.php';
    }
    public function sayHello(string $name)
    {
        echo 'Привет, ' . $name;
    }
    public function sayBye(string $name)
    {
        echo 'Пока, ' . $name;
    }
}
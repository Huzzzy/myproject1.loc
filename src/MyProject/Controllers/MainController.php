<?php

namespace MyProject\Controllers;

class MainController
{
    public function main()
    {
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
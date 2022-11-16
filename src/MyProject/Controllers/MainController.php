<?php

namespace MyProject\Controllers;

use MyProject\View\View;
use MyProject\Services\Db;

class MainController
{
    /** @var View */
    private $view;

    /** @var Db */
    private $db;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->db = new Db();
    }

    public function main()
    {
        $title = '';
        $articles = $this->db->query('SELECT * FROM `articles`;');
        $this->view->renderHtml('main/main.php', ['articles' => $articles], $title);
    }
    public function sayHello(string $name)
    {
        $title = 'Приветствие';
        $this->view->renderHtml('main/hello.php', ['name' => $name], $title);
    }
    public function sayBye(string $name)
    {
        echo 'Пока, ' . $name;
    }
}
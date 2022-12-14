<?php

namespace MyProject\Controllers;

use MyProject\View\View;
use MyProject\Services\Db;
use MyProject\Models\Articles\Article;

class MainController
{
    /** @var View */
    private $view;

    /** @var Db */
    private $db;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->db = Db::getInstance();
    }

    public function main()
    {
        $articles = $this->db->query('SELECT * FROM `articles`;', [], Article::class);
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }


    
    // public function sayHello(string $name)
    // {
    //     $title = 'Приветствие';
    //     $this->view->renderHtml('main/hello.php', ['name' => $name], $title);
    // }
    // public function sayBye(string $name)
    // {
    //     echo 'Пока, ' . $name;
    // }
}
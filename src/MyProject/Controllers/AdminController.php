<?php

namespace MyProject\Controllers;

use MyProject\Controllers\AbstractController;
use MyProject\Models\Articles\Article;
use MyProject\Models\Articles\ArticleComments;


class AdminController extends AbstractController {
    public function admin()
    {
        $articles = Article::findTheLastThreeColumns();
        $comments = ArticleComments::findTheLastThreeColumns();
        $this->view->renderHtml('admin/admin.php', [
            'articles' => $articles,
            'comments' => $comments
            ]);
    }
}
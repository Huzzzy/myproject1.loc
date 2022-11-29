<?php

namespace MyProject\Controllers;

use MyProject\Controllers\AbstractController;
use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Articles\ArticleComments;


class AdminController extends AbstractController
{
    public function admin()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if ($this->user->getRole() !== 'admin') {
                throw new ForbiddenException();
        }

        $articles = Article::findTheLastThreeColumns();
        $comments = ArticleComments::findTheLastThreeColumns();
        $this->view->renderHtml('admin/admin.php', [
            'articles' => $articles,
            'comments' => $comments
            ]);
    }
}
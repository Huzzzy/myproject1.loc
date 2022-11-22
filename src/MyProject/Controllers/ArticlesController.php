<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\Exceptions\NotFoundException;

class ArticlesController extends AbstractController
{
    public function view(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $this->view->renderHtml('articles/view.php', [
            'article' => $article
        ]);
    }

    public function edit(int $articleId): void
    {
        /** @var Article $article */
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');

        $article->save();
    }
    public function add(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        $this->view->renderHtml('articles/add.php');
    }
    public function delete(int $articleId):void 
    {
        /** @var Article $article */
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $article->delete();
        var_dump($article);
    }
}
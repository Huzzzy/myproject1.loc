<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Articles\ArticleComments;
use MyProject\Models\Users\User;
use MyProject\Exceptions\NotFoundException;

class ArticlesController extends AbstractController
{
    public function view(int $articleId)
    {
        $article = Article::getById($articleId);
        $comment = ArticleComments::getById($articleId);
        $comments = ArticleComments::findAll();

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $this->view->renderHtml('articles/view.php', [
            'article' => $article,
            'comment' => $comment,
            'comments' => $comments
        ]);
    }

    public function edit(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if ($this->user->getRole() !== 'admin') {
            throw new ForbiddenException();
        }

        if (!empty($_POST)) {
            try {
                $article->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php', ['error' => $e->getMessage(), 'article' => $article]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/edit.php', ['article' => $article]);
    }

    public function add(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }
        if ($this->user->getRole() !== 'admin') {
            throw new ForbiddenException();
        }

        if (!empty($_POST)) {
            try {
                $article = Article::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php');
    }

    public function delete(int $articleId): void
    {
        /** @var Article $article */
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $article->delete();

        header('Location: /');
    }

    public function commentsAdd(int $articleId): void
    {
        $article = Article::getById($articleId);
        $comment = ArticleComments::getById($articleId);
        $comments = ArticleComments::findAll();

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST)) {
            try {
                $comment = ArticleComments::createFromArray($_POST, $this->user, $article);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/view.php', ['error' => $e->getMessage(),
                    'article' => $article,
                    'comment' => $comment,
                    'comments' => $comments
                ]);
                return;
            }

            header('Location: /articles/' . $article->getId() . '#comment' . $comment->getId(), true, 302);
            exit();
        }

    }
        public function commentsEdit(int $articleId, int $commentId)
        {
            $article = Article::getById($articleId);
            $comment = ArticleComments::getById($commentId);
            $comments = ArticleComments::findAll();


            if ($this->user === null) {
                throw new UnauthorizedException();
            }

            if ($this->user->getRole() !== 'admin' || $this->user->getId() !== $comment->getAuthorId()) {
                throw new ForbiddenException();
            }

            if (!empty($_POST)) {
                try {
                    $comment->updateFromArray($_POST);
                } catch (InvalidArgumentException $e) {
                    $this->view->renderHtml('articles/view.php', ['error' => $e->getMessage(),
                        'article' => $article,
                        'comment' => $comment,
                        'comments' => $comments
                    ]);
                    return;
                }

                header('Location: /articles/' . $article->getId(), true, 302);
                exit();
            }
        }

}
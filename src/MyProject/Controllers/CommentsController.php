<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Articles\ArticleComments;

class CommentsController extends AbstractController
{
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

        if ($this->user->getRole() !== 'admin') {
            if ($this->user->getId() !== $comment->getAuthorId()) {
                throw new ForbiddenException();
            }
        }

        if (!empty($_POST)) {
            try {
                $comment->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/view.php', ['error' => $e->getMessage(),
                    'article' => $article,
                    'comments' => $comments
                ]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }
    }

    public function commentsDelete(int $articleId, int $commentId):void
    {
        $comment = ArticleComments::getById($commentId);
        $article = Article::getById($articleId);

        if ($comment === null) {
            throw new NotFoundException();
        }

        $comment->delete();

        header('Location: /articles/' . $article->getId(), true, 302);
        exit();
    }
}
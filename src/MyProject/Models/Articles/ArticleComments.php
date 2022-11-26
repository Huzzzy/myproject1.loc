<?php

namespace MyProject\Models\Articles;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;
use MyProject\Models\Articles\Article;

class ArticleComments extends ActiveRecordEntity
{
    /** @var string */
    protected $articleId;

    /** @var string */
    protected $authorId;

    /** @var string */
    protected $text;

    /** @var string */
    protected $createdAt;

    protected static function getTableName(): string
    {
        return 'comments';
    }

    /**
     * @return int
     */

    public function setArticleId($articleId):void
    {
        $this->articleId = $articleId->getId();
    }

    public function getArticleId():int
    {
        return $this->articleId;
    }

    public function getText(): string
    {
        return $this->text;
    }
    public function setText($text):void
    {
        $this->text = $text;
    }

    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }
    /**
     * @param User $author
     */
    public function setAuthorId(User $author): void
    {
        $this->authorId = $author->getId();
    }

    public static function createFromArray(array $fields, User $author, Article $article):ArticleComments
    {
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст комментария');
        }

        $comment = new ArticleComments();

        $comment->setAuthorId($author);
        $comment->setArticleId($article);
        $comment->setText($fields['text']);

        $comment->save();

        return $comment;
    }

    public function updateFromArray(array $fields): ArticleComments
    {
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст комментария');
        }

        $this->setText($fields['text']);

        $this->save();

        return $this;
    }

}
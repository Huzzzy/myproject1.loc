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

    public function setArticleId(Article $id):void
    {
        $this->articleId = $id->getId();
    }

    public function getText(): string
    {
        return $this->text;
    }
    public function setText($text):void
    {
        $this->text = $text->getId();
    }

    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }
    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }

    public static function createFromArray(array $fields, User $author):ArticleComments
    {
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст комментария');
        }

        $comment = new ArticleComments();

        $comment->setAuthor($author);
        $comment->setText($fields['text']);

        $comment->save();

        return $comment;
    }

}
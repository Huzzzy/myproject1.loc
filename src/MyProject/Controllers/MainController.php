<?php

namespace MyProject\Controllers;


use MyProject\Models\Articles\Article;

class MainController extends AbstractController
{
    public function main()
    {
        $lastID = Article::getLastID();
        if ($lastID === null) {
            throw new NotFoundException();
        }
        $this->after($lastID + 1);
    }

    public function before(int $id)
    {
        $this->page(Article::getPageBefore($id, 5));
    }

    public function after(int $id)
    {
        $this->page(Article::getPageAfter($id, 5));
    }

    private function page(array $articles)
    {
        if ($articles === []) {
            throw new NotFoundException();
        }

        $firstID = $articles[0]->getId();
        $lastID = $articles[count($articles)-1]->getId();

        $this->view->renderHtml('main/main.php', [
            'articles' => $articles,
            'previousPageLink' => $firstID < $this->getLastArticleID() ? '/before/' . $firstID : null,
            'nextPageLink' => $lastID > 1 ? '/after/' . $lastID : null,
        ]);
    }

    private function getLastArticleID(): int
    {
        $cacheFile = __DIR__ . '/../../../cache/last_article_id';
        $value_from_cache = file_get_contents($cacheFile);
        if (!empty($value_from_cache)) {
            return (int)$value_from_cache;
        }

        $lastID = Article::getLastID();
        file_put_contents($cacheFile, $lastID);
        return $lastID;
    }
}
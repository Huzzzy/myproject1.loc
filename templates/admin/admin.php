<?php include __DIR__ . '/../header.php'; ?>
<h2>Последние статьи</h2>
<?php foreach ($articles as $article){ ?>
    <h2><a href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h2>
    <p><?= $article->getShortText() ?></p>
    <hr>
<?php } ?>
<h2>Последние комментарии</h2>
<?php foreach ($comments as $comment){ ?>
    <p id="comment<?php $comment->getId() ?>"><?= $comment->getAuthor()->getNickname() ?>
        <?= $comment->getText() ?></p>
<?php } ?>
<?php include __DIR__ . '/../footer.php'; ?>

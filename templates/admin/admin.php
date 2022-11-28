<?php include __DIR__ . '/../header.php'; ?>
<h2>Последние статьи</h2>
<?php foreach ($articles as $article){ ?>
    <h2><a href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h2>
    <p><?= $article->getShortText() ?></p>
    <a href="/articles/<?= $article->getId() ?>/edit">Редактировать</a>
    <a href="/articles/<?= $article->getId() ?>/delete">Удалить</a>
    <hr>
<?php } ?>
<h2>Последние комментарии</h2>
<?php foreach ($comments as $comment){ ?>
    <p id="comment<?php $comment->getId() ?>"><?= $comment->getAuthor()->getNickname() ?>:
        <?= $comment->getText() ?></p>
    <form action="/articles/<?= $article->getId() ?>/comments/<?= $comment->getId() ?>/edit" method="post">
        <label for="text">Редактировать комментарий</label><br>
        <textarea name="text" id="text" rows="2" cols="50"><?= $_POST['text'] ?? '' ?></textarea><br>

        <input type="submit" value="Редактировать">
    </form>
    <hr>
<?php } ?>
<?php include __DIR__ . '/../footer.php'; ?>

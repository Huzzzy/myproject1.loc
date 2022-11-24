<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    <p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
    <?php if(!empty($user) && $user->getRole() === 'admin'): ?>
    <a href="http://myproject1.loc/articles/<?= $article->getId()?>/edit">Редактировать</a>
    <a href="http://myproject1.loc/articles/<?= $article->getId()?>/delete">Удалить</a>
    <? endif; ?>
<?php include __DIR__ . '/../footer.php'; ?>
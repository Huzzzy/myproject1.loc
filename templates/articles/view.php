<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    <p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
    <h1>Комментарии</h1>
    <p><?= $comments->getAuthor?></p>
    <p><?= $comments->getText() ?></p>
    <?php if(!empty($user)){ ?>
    <form action="/articles/<?= $article->getId()?>/comments" method="post">
    <label for="text">Написать комментарий</label><br>
    <textarea name="text" id="text" rows="4" cols="50"><?= $_POST['text'] ?? '' ?></textarea><br>
    <br>
    <input type="submit" value="Опубликовать">
    </form>
    <?php } ?>
    <?php if(!empty($user) && $user->getRole() === 'admin'){ ?>
    <a href="/articles/<?= $article->getId()?>/edit">Редактировать</a>
    <a href="/articles/<?= $article->getId()?>/delete">Удалить</a>
    <?php } ?>
<?php include __DIR__ . '/../footer.php'; ?>
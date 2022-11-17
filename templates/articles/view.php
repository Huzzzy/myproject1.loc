<?php include __DIR__ . '/../header.php'; ?>
    <p>Имя автора: <?= $nickname ?></p>
    <h1><?= $article['name'] ?></h1>
    <p><?= $article['text'] ?></p>
<?php include __DIR__ . '/../footer.php'; ?>
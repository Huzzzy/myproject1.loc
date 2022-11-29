<?php include __DIR__ . '/../header.php'; ?>
    <div>
        <?= $user->getNickname() ?>
    </div>

    <h2>Загрузить фотографию</h2>
<form action="/" method="post" enctype="multipart/form-data">
    <input type="file" name="attachment">
    <input type="submit">
</form>
<?php include __DIR__ . '/../footer.php'; ?>

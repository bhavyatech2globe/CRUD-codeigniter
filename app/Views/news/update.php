<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/news/update" method="post">
    <?= csrf_field() ?>

    <input type="hidden" name="id" value="<?=$news['id']?>">
    <label for="title">Title</label>
    <input type="input" name="title" value="<?= $news['title'] ?>">
    <br>

    <label for="body">Text</label>
    <textarea name="body" cols="45" rows="4"><?= $news['body'] ?></textarea>
    <br>

    <input type="submit" name="submit" value="Update news item">
</form>
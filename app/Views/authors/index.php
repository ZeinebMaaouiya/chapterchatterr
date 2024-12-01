<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php foreach ($authors as $author): ?>
    <div>
        <h3><?= esc($author['name']); ?></h3>
        <p><?= esc($author['bio']); ?></p>
        <a href="/author/edit/<?= $author['id']; ?>">Edit</a>
        <a href="/author/delete/<?= $author['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
    </div>
<?php endforeach; ?>
<a href="/author/create">Add New Author</a>

</body>
</html>
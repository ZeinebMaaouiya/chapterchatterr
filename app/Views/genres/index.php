<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php foreach ($genres as $genre): ?>
    <div>
        <h3><?= esc($genre['name']); ?></h3>
        <a href="/genre/edit/<?= $genre['id']; ?>">Edit</a>
        <a href="/genre/delete/<?= $genre['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
    </div>
<?php endforeach; ?>
<a href="/genre/create">Add New Genre</a>

</body>
</html>
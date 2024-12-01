<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php foreach ($categories as $category): ?>
    <div>
        <h3><?= esc($category['name']); ?></h3>
        <a href="/category/edit/<?= $category['id']; ?>">Edit</a>
        <a href="/category/delete/<?= $category['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
    </div>
<?php endforeach; ?>
<a href="/category/create">Add New Category</a>

</body>
</html>
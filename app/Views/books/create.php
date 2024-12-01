<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="/book/store" method="post">
    <input type="text" name="name" placeholder="Book Name" required>
    <select name="author_id">
        <?php foreach ($authors as $author): ?>
            <option value="<?= $author['id']; ?>"><?= esc($author['name']); ?></option>
        <?php endforeach; ?>
    </select>
    <select name="category_id">
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id']; ?>"><?= esc($category['name']); ?></option>
        <?php endforeach; ?>
    </select>
    <select name="genre_id">
        <?php foreach ($genres as $genre): ?>
            <option value="<?= $genre['id']; ?>"><?= esc($genre['name']); ?></option>
        <?php endforeach; ?>
    </select>
    <textarea name="description" placeholder="Description"></textarea>
    <button type="submit">Save</button>
</form>

</body>
</html>
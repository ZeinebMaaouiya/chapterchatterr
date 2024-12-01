<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="/book/update/<?= $book['id']; ?>" method="post">
    <input type="text" name="name" value="<?= esc($book['name']); ?>" required>
    <select name="author_id">
        <?php foreach ($authors as $author): ?>
            <option value="<?= $author['id']; ?>" <?= $author['id'] == $book['author_id'] ? 'selected' : ''; ?>>
                <?= esc($author['name']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <select name="category_id">
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id']; ?>" <?= $category['id'] == $book['category_id'] ? 'selected' : ''; ?>>
                <?= esc($category['name']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <select name="genre_id">
        <?php foreach ($genres as $genre): ?>
            <option value="<?= $genre['id']; ?>" <?= $genre['id'] == $book['genre_id'] ? 'selected' : ''; ?>>
                <?= esc($genre['name']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <textarea name="description"><?= esc($book['description']); ?></textarea>
    <button type="submit">Update</button>
</form>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="/category/update/<?= $category['id']; ?>" method="post">
    <input type="text" name="name" value="<?= esc($category['name']); ?>" required>
    <button type="submit">Update</button>
</form>

</body>
</html>
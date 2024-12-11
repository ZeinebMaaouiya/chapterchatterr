<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors List</title>
    <style>
        .author-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .author-image {
            margin-right: 20px;
        }

        .author-image img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 50%;
            border: 1px solid #ddd;
        }

        .author-details {
            flex: 1;
        }

        .actions a {
            margin-right: 10px;
            text-decoration: none;
            color: #007BFF;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        .default-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Authors List</h1>

    <?php foreach ($authors as $author): ?>
        <div class="author-card">
        <div class="author-image">
            <?php if (!empty($author['profile_picture'])): ?>
                <!-- Display image if exists -->
                <img src="<?= base_url($author['profile_picture']); ?>" alt="Profile Picture">
            <?php else: ?>
                <img src="<?= base_url('public/img/default-profile.png'); ?>" alt="Default Profile">
            <?php endif; ?>
        </div>
            <div class="author-details">
                <h3><?= esc($author['name']); ?></h3>
                <p><strong>Bio:</strong> <?= esc($author['bio']); ?></p>
                <p><strong>Birthdate:</strong> <?= esc($author['birthdate']); ?></p>
                <p><strong>Age:</strong> <?= esc($author['age']); ?></p>
                <p><strong>Gender:</strong> <?= esc($author['gender']); ?></p>
            </div>
            <div class="actions">
                <a href="/author/edit/<?= $author['id']; ?>">Edit</a>
                <a href="/author/delete/<?= $author['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </div>
        </div>
    <?php endforeach; ?>

    <a href="/author/create">Add New Author</a>
</body>
</html>

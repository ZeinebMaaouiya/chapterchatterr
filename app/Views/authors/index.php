<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors List</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="https://fontawesome.com/start">
    <link rel="icon" href="/favicon.ico">
    <link rel="icon" href="/images/favicon/icon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/images/favicon/apple-touch-icon.png">
    <link rel="manifest" href="/manifest/app.json">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
    <link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
</head>
<body class="author">
<header>
        <div>
        <img src="<?= base_url('img/logo.png'); ?>" alt="Logo">
        <h1>chapter<span>chatter</span></h1>
        </div>
        <div>
            <ul>
                <li><a href="/">home</a></li>
                <li><a href="/category">categories</a></li>
                <li><a href="/book">bookes</a></li>
                <li><a href="/author">autours</a></li>
                <li><a href="/login">Log-in</a></li>
            </ul>
            <div class="divIcone">
                <input type="search" placeholder="search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
        <div class="signe">
            <p><a href="/login">sign in</a></p>
            <i class="fa-solid fa-user"></i>
        </div>
    </header>
    <main>
        <h1>Authors List</h1>

        <?php foreach ($authors as $author): ?>
            <div class="author-card">
            <div class="author-image">
                <?php if (!empty($author['profile_picture'])): ?>
                    <!-- Display image if exists -->
                    <img src="<?= base_url($author['profile_picture']); ?>" alt="Profile Picture">
                <?php else: ?>
                    <div class="default-img">No Image</div>
                <?php endif; ?>
            </div>
                <div class="author-details">
                    <h3><?= esc($author['name']); ?></h3>
                    <p><strong>Bio:</strong> <?= esc($author['bio']); ?></p>
                    <p><strong>Birthdate:</strong> <?= esc($author['birthdate']); ?></p>
                    <p><strong>Gender:</strong> <?= esc($author['gender']); ?></p>
                </div>
                <?php if (session('user_type') === 'admin'): ?>
                <div class="actions">
                    <a href="/author/edit/<?= $author['id']; ?>">Edit</a>
                    <a href="/author/delete/<?= $author['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </div>
            <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <?php if (session('user_type') === 'admin'): ?>
            <a href="/author/create" class="add-new">Add New Author</a>
        <?php endif; ?>
    </main>
</body>
</html>

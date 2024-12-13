<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title><link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
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

</head>
<body class="cata">
<header class="category">
        <div>
        <img src="<?= base_url('img/logo.png'); ?>" alt="Logo">
        <h1>chapter<span>chatter</span></h1>
        </div>
        <div>
            <ul>
                <li><a href="/">home</a></li>
                <li><a href="/book">bookes</a></li>
                <li><a href="/author">autours</a></li>
                <?php if (session()->has('user')): ?>
                    <?= session('user')['nom'] ?> <?= session('user')['prenom'] ?>
                <?php else: ?>
                    <li><a href="/login">Log-in</a></li>
                <?php endif; ?>
            </ul>
            <div class="divIcone">
                <input type="search" placeholder="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
        <div class="signe">
            <p><a href="/login">Sign in</a></p>
            <i class="fa-solid fa-user"></i>
        </div>
    </header>
    <main cl>
        <?php foreach ($categories as $category): ?>
        <div>
            <h3><?= esc($category['name']); ?></h3>
            <div class="actions">
                    <a href="/category/edit/<?= $category['id']; ?>">Edit</a>
                    <a href="/category/delete/<?= $category['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </div>
            <?php if (session('user_type') === 'admin'): ?>
                
            <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <a href="/category/create">Add New Category</a>
            <?php if (session('user_type') === 'admin'): ?>
               
            <?php endif; ?>
    </main>
</body>
</html>
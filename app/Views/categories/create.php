<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
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
                <input type="search" placeholder="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
        <div class="signe">
            <p><a href="/login">Sign in</a></p>
            <i class="fa-solid fa-user"></i>
        </div>
    </header>
<form action="/category/store" method="post">
    <input type="text" name="name" placeholder="Category Name" required>
    <button type="submit">Save</button>
</form>

</body>
</html>
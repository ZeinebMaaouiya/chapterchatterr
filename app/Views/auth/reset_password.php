<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body class="register">
    <header class=" header">
        <div id="btn" class="btn">
                <i class="fa-sharp fa-solid fa-bars"></i>
        </div>
        <img src="<?=base_url('/img/Preview-removebg-preview.png')?>" alt="">
        
        <div class="signe">
                <p> <a href="/login">signe in</a></p>
                <i class="fa-solid fa-user"></i>
        </div>
    </header>
   <main>
        <div>
            <form action="/reset-password" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="token" value="<?= esc($token) ?>">
                <input type="password" name="password" placeholder="Nouveau mot de passe" required>
                <button type="submit">Réinitialiser le mot de passe</button>
            </form>
            <?php if (session('error')): ?>
                <p class="error"><?= session('error') ?></p>
            <?php endif; ?>
        </div>
   </main>
</body>
</html>

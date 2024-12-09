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
        <form action="/forgot-password" method="post">
            <?= csrf_field() ?>
            <input type="email" name="email" placeholder="Votre email" required>
            <button type="submit">Envoyer un lien de réinitialisation</button>
        </form>
        <?php if (session('error')): ?>
            <p class="error"><?= session('error') ?></p>
        <?php endif; ?>
        <?php if (session('success')): ?>
            <p class="success"><?= session('success') ?></p>
        <?php endif; ?>

    </main>
</body>
</html>

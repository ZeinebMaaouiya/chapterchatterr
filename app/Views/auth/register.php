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
        <h3>Create Account</h3>
        <form action="/register" method="post">
            <?= csrf_field() ?>
            <input type="text" name="nom" placeholder="Nom" value="<?= old('nom') ?>">
            <?= session('errors.nom') ?>
            
            <input type="text" name="prenom" placeholder="Prénom" value="<?= old('prenom') ?>">
            <?= session('errors.prenom') ?>
            
            <input type="email" name="email" placeholder="Email" value="<?= old('email') ?>">
            <?= session('errors.email') ?>
            
            <input type="password" name="password" placeholder="Mot de passe">
            <?= session('errors.password') ?>
            
            <button type="submit">S'inscrire</button>
        </form>
       <div>
        <?php if (session()->getFlashdata('error')): ?>
                <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
            <?php endif; ?>

            <?php if (session()->getFlashdata('message')): ?>
                <p style="color: green;"><?= session()->getFlashdata('message') ?></p>
            <?php endif; ?>
       </div>
    </main>
</body>
</html>

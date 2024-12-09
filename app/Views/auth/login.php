<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    
</head>
<body class="register" >
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
        <h3>Se connecter</h3>
        <form action="/login" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" value="<?= old('email') ?>" required>
                <?php if (session('errors.email')): ?>
                    <p style="color: red;"><?= session('errors.email') ?></p>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <input type="password" name="password" placeholder="Mot de passe" required>
                <?php if (session('errors.password')): ?>
                    <p style="color: red;"><?= session('errors.password') ?></p>
                <?php endif; ?>
            </div>
            
            <button type="submit">Se connecter</button>
        </form>

       <div>
            <div class="forgot-password">
                <a href="/forgot-password">Mot de passe oublié ?</a>
            </div>

            <div class="register-link">
                <p>Pas encore de compte ? <a href="/register">Créer un compte</a></p>
            </div>

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

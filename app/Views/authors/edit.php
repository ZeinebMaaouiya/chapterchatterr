<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Author</title>
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
<body class="create">
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
                <?php if (session()->has('user')): ?>
                    <?= session('user')['nom'] ?> <?= session('user')['prenom'] ?>
                <?php else: ?>
                    <li><a href="/login">Log-in</a></li>
                <?php endif; ?>
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

    <main class="createBook">
        <form action="/author/update/<?= $author['id']; ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?= esc($author['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea name="bio" id="bio"><?= esc($author['bio']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture">
                <?php if (!empty($author['profile_picture'])): ?>
                    <img src="/img/<?= esc($author['profile_picture']); ?>" alt="<?= esc($author['name']); ?>">
                <?php else: ?>
                    <img src="/img/default-profile.png" alt="Default Profile">
                <?php endif; ?>


            <div class="form-group">
                <label for="birthdate">Birthdate</label>
                <input type="date" name="birthdate" id="birthdate" value="<?= esc($author['birthdate']); ?>">
            </div>

           
            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                    <option value="Male" <?= $author['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?= $author['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                    <option value="Other" <?= $author['gender'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="nationality">Nationality</label>
                <input type="text" name="nationality" id="nationality" value="<?= esc($author['nationality']); ?>">
            </div>

            <button type="submit">Update</button>
        </form>
    </main>

    <footer></footer>
</body>
</html>

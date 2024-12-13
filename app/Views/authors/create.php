<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Author</title>
    <link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
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
                <input type="search" placeholder="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
        <div class="signe">
            <p><a href="/login">Sign in</a></p>
            <i class="fa-solid fa-user"></i>
        </div>
    </header>
    <main class="createBook">
        <h2>Create a New Author</h2>
        <form action="/author/store" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <!-- Name -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?= old('name'); ?>" required>
            </div>

            <!-- Bio -->
            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea name="bio" id="bio"><?= old('bio'); ?></textarea>
            </div>

            <!-- Profile Picture -->
            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture">
            </div>

            <!-- Birthdate -->
            <div class="form-group">
                <label for="birthdate">Birthdate</label>
                <input type="date" name="birthdate" id="birthdate" value="<?= old('birthdate'); ?>">
            </div>
           

            <!-- Gender -->
            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                    <option value="Male" <?= old('gender') == 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?= old('gender') == 'Female' ? 'selected' : ''; ?>>Female</option>
                    <option value="Other" <?= old('gender') == 'Other' ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>

            <!-- Nationality -->
            <div class="form-group">
                <label for="nationality">Nationality</label>
                <input type="text" name="nationality" id="nationality" value="<?= old('nationality'); ?>">
            </div>

            <!-- Submit Button -->
            <button type="submit">Submit</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Chapter Chatter. All rights reserved.</p>
    </footer>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Author</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
</head>
<body class="create">
    <header>
        <div>
            <img src="<?= base_url('public/img/Preview-removebg-preview.png'); ?>" alt="Logo">
            <h1>chapter<span>chatter</span></h1>
        </div>
        <div>
            <ul>
                <li><a href="/about">About</a></li>
                <li><a href="/home">Home</a></li>
                <li><a href="/categories">Categories</a></li>
                <li><a href="/top">Top</a></li>
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

            <!-- Age -->
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" name="age" id="age" value="<?= old('age'); ?>">
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

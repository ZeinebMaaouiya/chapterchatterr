<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Book</title>
    <link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
</head>
<body class="create">
    <header>
        <div>
            <img src="/public/img/Preview-removebg-preview.png" alt="Chapter Chatter">
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
                <i class="fa fa-magnifying-glass"></i>
            </div>
        </div>
        <div class="signe">
            <p><a href="/login">Sign in</a></p>
            <i class="fa fa-user"></i>
        </div>
    </header>

    <main class="createBook">
        <h2>Create a New Book</h2>
        <form action="/book/store" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <!-- Book Name -->
            <div class="form-group">
                <label for="name">Book Title</label>
                <input type="text" id="name" name="name" value="<?= old('name'); ?>" required>
                <?= \Config\Services::validation()->getError('name'); ?>
            </div>

            <!-- Author -->
            <div class="form-group">
                <label for="author_id">Author</label>
                <select name="author_id" id="author_id" required>
                    <option value="">Select an author</option>
                    <?php foreach ($authors as $author): ?>
                        <option value="<?= $author['id']; ?>" <?= old('author_id') == $author['id'] ? 'selected' : ''; ?>>
                            <?= esc($author['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?= \Config\Services::validation()->getError('author_id'); ?>
            </div>

            <!-- Categories -->
            <div class="form-group">
                <label>Categories</label>
                <div class="categories-checkboxes">
                    <?php foreach ($categories as $category): ?>
                        <label>
                            <input type="checkbox" name="category_id[]" value="<?= $category['id']; ?>"
                                <?= in_array($category['id'], old('category_id', [])) ? 'checked' : ''; ?>>
                            <?= esc($category['name']); ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>
                <?= \Config\Services::validation()->getError('category_id'); ?>
            </div>

            <!-- Summary -->
            <div class="form-group">
                <label for="summary">Summary</label>
                <textarea name="summary" id="summary" rows="5"><?= old('summary'); ?></textarea>
                <?= \Config\Services::validation()->getError('summary'); ?>
            </div>

            <!-- Pages -->
            <div class="form-group">
                <label for="pages">Number of Pages</label>
                <input type="number" name="pages" id="pages" value="<?= old('pages'); ?>" required>
                <?= \Config\Services::validation()->getError('pages'); ?>
            </div>

            <!-- Published Date -->
            <div class="form-group">
                <label for="published_date">Published Date</label>
                <input type="date" name="published_date" id="published_date" value="<?= old('published_date'); ?>" required>
                <?= \Config\Services::validation()->getError('published_date'); ?>
            </div>

            <!-- ISBN -->
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" name="isbn" id="isbn" value="<?= old('isbn'); ?>" required>
                <?= \Config\Services::validation()->getError('isbn'); ?>
            </div>

            <!-- ASIN -->
            <div class="form-group">
                <label for="asin">ASIN</label>
                <input type="text" name="asin" id="asin" value="<?= old('asin'); ?>" required>
                <?= \Config\Services::validation()->getError('asin'); ?>
            </div>

            <!-- Language -->
            <div class="form-group">
                <label for="language">Language</label>
                <select name="language" id="language" required>
                    <option value="">Select Language</option>
                    <option value="English" <?= old('language') == 'English' ? 'selected' : ''; ?>>English</option>
                    <option value="French" <?= old('language') == 'French' ? 'selected' : ''; ?>>French</option>
                    <option value="Spanish" <?= old('language') == 'Spanish' ? 'selected' : ''; ?>>Spanish</option>
                    <option value="German" <?= old('language') == 'German' ? 'selected' : ''; ?>>German</option>
                    <!-- Add more languages as needed -->
                </select>
                <?= \Config\Services::validation()->getError('language'); ?>
            </div>

            <!-- Format -->
            <div class="form-group">
                <label for="format">Format</label>
                <select name="format" id="format" required>
                    <option value="">Select Format</option>
                    <option value="Hardcover" <?= old('format') == 'Hardcover' ? 'selected' : ''; ?>>Hardcover</option>
                    <option value="Paperback" <?= old('format') == 'Paperback' ? 'selected' : ''; ?>>Paperback</option>
                    <option value="E-book" <?= old('format') == 'E-book' ? 'selected' : ''; ?>>E-book</option>
                    <option value="Audiobook" <?= old('format') == 'Audiobook' ? 'selected' : ''; ?>>Audiobook</option>
                </select>
                <?= \Config\Services::validation()->getError('format'); ?>
            </div>

            <!-- Cover Image -->
            <div class="form-group">
                <label for="cover_image">Cover Image</label>
                <input type="file" name="cover_image" id="cover_image" required>
                <?= \Config\Services::validation()->getError('cover_image'); ?>
            </div>

            <button type="submit">Save Book</button>
        </form>
    </main>
</body>
</html>

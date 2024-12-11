<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Review</title>
    <link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
</head>
<body class="indexBook">
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
            <div class="search-bar">
                <input type="search" placeholder="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
        <div class="signe">
            <p><a href="/login">Sign In</a></p>
            <i class="fa-solid fa-user"></i>
        </div>
    </header>
    <main>
        <?php foreach ($book as $bookDetail): ?>
        <section class="book-section">
            <div class="book-cover">
                <?php if (!empty($bookDetail['cover_image'])): ?>
                <img src="/uploads/<?= esc($bookDetail['cover_image']); ?>" alt="<?= esc($bookDetail['name']); ?>">
                <?php else: ?>
                <img src="/public/img/default-cover.png" alt="Default Cover">
                <?php endif; ?>
            </div>
            <div class="book-details">
                <h3><?= esc($bookDetail['name']); ?></h3>
                <p>By: <a href="#"><p>By: <a href="#"><?= esc($bookDetail['author_name']); ?></a></p></a></p>
                <p><?= esc($bookDetail['summary'] ?? 'No description available'); ?></p>
                <p><?= esc($bookDetail['pages'] ?? 'N/A'); ?> pages</p>
                <p>First Published: <?= esc($bookDetail['published_date'] ?? 'Unknown'); ?></p>
                <div>
                    <h5>Genres:</h5>
                    <ul>
                        <?php if (!empty($bookDetail['categories'])): ?>
                            <?php foreach ($bookDetail['categories'] as $category): ?>
                                <li><?= esc($category['name']); ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>Uncategorized</li>
                        <?php endif; ?>
                    </ul>
                </div>

                </div>
                <div class="book-meta">
                    <ul>
                        <li>Format: <?= esc($bookDetail['format'] ?? 'N/A'); ?></li>
                        <li>ISBN: <?= esc($bookDetail['isbn'] ?? 'N/A'); ?></li>
                        <li>ASIN: <?= esc($bookDetail['asin'] ?? 'N/A'); ?></li>
                        <li>Language: <?= esc($bookDetail['language'] ?? 'N/A'); ?></li>
                    </ul>
                </div>
                <div class="actions">
                    <a href="/book/edit/<?= $bookDetail['id']; ?>">Edit</a>
                    <a href="/book/delete/<?= $bookDetail['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </div>
            </div>
        </section>
        <?php endforeach; ?>
        <a href="/book/create" class="add-new">Add New Book</a>
    </main>
    <footer>
        <p>&copy; 2024 Chapter Chatter. All rights reserved.</p>
    </footer>
</body>
</html>

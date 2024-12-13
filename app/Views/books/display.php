<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Review - <?= esc($book['name']); ?></title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://fontawesome.com/start">
    <link rel="icon" href="/favicon.ico">
    <link rel="icon" href="/images/favicon/icon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/images/favicon/apple-touch-icon.png">
    <link rel="manifest" href="/manifest/app.json">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
    <link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
</head>
<body class="indexBook">
    <header>
        <div>
            <img src="<?= base_url('img/logo.png'); ?>" alt="Logo">
            <h1>chapter<span>chatter</span></h1>
        </div>
        <div>
            <ul>
                <li><a href="/">home</a></li>
                <li><a href="/category">categories</a></li>
                <li><a href="/book">books</a></li>
                <li><a href="/author">authors</a></li>
                <?php if (session()->has('user')): ?>
                    <?= session('user')['nom'] ?> <?= session('user')['prenom'] ?>
                <?php else: ?>
                    <li><a href="/login">Log-in</a></li>
                <?php endif; ?>
            </ul>
            <div class="search-bar">
                <input type="search" placeholder="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
        <div class="signe">
            <?php if (session()->has('user')): ?>
                <p><a href="/logout">Log Out</a></p>
            <?php else: ?>
                <p><a href="/login">Sign In</a></p>
            <?php endif; ?>
            <i class="fa-solid fa-user"></i>
        </div>
    </header>

    <main>
        <?php if ($book): ?>
            <section class="firstsec">
                <div class="book-cover">
                    <?php if (!empty($book['cover_image'])): ?>
                        <img src="<?= base_url('public/img/' . esc($book['cover_image'])); ?>" alt="<?= esc($book['name']); ?>" class="book-image">
                    <?php else: ?>
                        <img src="<?= base_url('public/img/default-cover.png'); ?>" alt="Default Cover" class="book-image">
                    <?php endif; ?>
                </div>
                <div id="rating-section" data-book-id="<?= $book['id']; ?>">
                    <h3>Rate this book:</h3>
                    <div class="stars">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span class="star" data-value="<?= $i; ?>">&#9733;</span>
                        <?php endfor; ?>
                    </div>
                    <p id="average-rating">Average Rating: <?= esc($averageRating ?? 'Not Rated'); ?></p>
                </div>
            </section>

            <section class="secsection">
                <div class="book-details">
                    <h3><?= esc($book['name']); ?></h3>
                    <p>By: <a href="#"><?= esc($book['author_name']); ?></a></p>
                    <p><?= esc($book['summary'] ?? 'No description available'); ?></p>
                    <p>Pages: <?= esc($book['pages'] ?? 'N/A'); ?> pages</p>
                    <p>First Published: <?= esc($book['published_date'] ?? 'Unknown'); ?></p>

                    <div>
                        <h5>Genres:</h5>
                        <ul>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <li><?= esc($category['name']); ?></li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>Uncategorized</li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <div class="book-meta">
                        <ul>
                            <li>Format: <?= esc($book['format'] ?? 'N/A'); ?></li>
                            <li>ISBN: <?= esc($book['isbn'] ?? 'N/A'); ?></li>
                            <li>ASIN: <?= esc($book['asin'] ?? 'N/A'); ?></li>
                            <li>Language: <?= esc($book['language'] ?? 'N/A'); ?></li>
                        </ul>
                    </div>
                </div>
            </section>
        <?php else: ?>
            <p>Book not found.</p>
        <?php endif; ?>

        <section id="comments-section">
        <h3>Comments:</h3>

        <!-- Comment form -->
        <?php if (session()->has('user')): ?>
            <form method="POST" action="<?= base_url('comment/create'); ?>">
                <textarea name="comment" placeholder="Write your comment here..." required></textarea>
                <input type="hidden" name="book_id" value="<?= $book['id']; ?>">
                <button type="submit">Submit</button>
            </form>
        <?php else: ?>
            <p>You must be logged in to comment.</p>
        <?php endif; ?>

        <!-- Display the comments -->
        <ul>
        <?php if (empty($comments)): ?>
        <p>No comments yet.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($comments as $comment): ?>
                    <li>
                        <strong>User <?= esc($comment['user_id']); ?>:</strong>
                        <p><?= esc($comment['content']); ?></p>
                        <!-- Edit and Delete options -->
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        </ul>
    </section>
        </div>

        
            <div class="actions">
                <a href="/book/edit/<?= $book['id']; ?>">Edit</a>
                <a href="/book/delete/<?= $book['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </div>
            
        

        <a href="/book/create" class="add-new">Add New Book</a>
    </main>

    <footer>
        <p>&copy; 2024 Chapter Chatter. All rights reserved.</p>
    </footer>

    
    </script>
</body>
</html>

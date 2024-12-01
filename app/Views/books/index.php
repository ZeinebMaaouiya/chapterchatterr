<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>book review</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://fontawesome.com/start">
    <link rel="icon" href="/favicon.ico">
    <link rel="icon" href="/images/favicon/icon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/images/favicon/apple-touch-icon.png">
    <link rel="manifest" href="/manifest/app.json">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <script defer src="<?= base_url('js/main.js') ?>"></script>
</head>
<body>
    <header>
        <div>
            <img src="/public/img/Preview-removebg-preview.png (1).png" alt="">
            <h1>chapter<span>chatter</span></h1>
        </div>
        <div>
            <ul>
                <li>about</li>
                <li>home</li>
                <li>categorie</li>
                <li>top</li>
            </ul>
            <div class="divIcone">
                <input type="search" placeholder=" search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
        <div class="signe">
            <p> <a href="/login">signe in</a></p>
            <i class="fa-solid fa-user"></i>
        </div>
    </header>
    <main>
        <section>
            <img src="" alt="" >
            <button></button>
            <button></button>
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5"><label for="star5">★</label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
            </div>
            <p>rate this book </p>
        </section>
        <section>
            <div>
                <h3>Animals Make Us Human: Creating the Best Life for Animals</h3>
                <p><a href="">auther</a></p>
            </div>
            <div>
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5"><label for="star5">★</label>
                    <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
                    <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
                    <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
                    <input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
                </div>
                <ul>
                    <li>680 rating</li>
                    <li>reviews</li>
                </ul>
                <p>
                    The best-selling animal advocate Temple Grandin offers the most exciting exploration of how animals feel since The Hidden Life of Dogs.
                    In her groundbreaking and best-selling book Animals in Translation, Temple Grandin drew on her own experience with autism as well as her distinguished career as an animal scientist to deliver extraordinary insights into how animals think, act, and feel. Now she builds on those insights to show us how to give our animals the best and happiest lifeon their terms, not ours.
                    It's usually easy to pinpoint the cause of physical pain in animals, but to know what is causing them emotional distress is much harder. Drawing on the latest research and her own work, Grandin identifies the core emotional needs of animals. Then she explains how to fulfill them for dogs and cats, horses, farm animals, and zoo animals. Whether it's how to make the healthiest environment for the dog you must leave alone most of the day, how to keep pigs from being bored, or how to know if the lion pacing in the zoo is miserable or just exercising, Grandin teaches us to challenge our assumptions about animal contentment and honor our bond with our fellow creatures.
                    Animals Make Us Human is the culmination of almost thirty years of research, experimentation, and experience.
                </p>
                <div>
                    <h6>Genres</h6>
                    <ul>
                        <li><a href="">Nonfiction</a></li>
                        <li><a href="">Animals</a></li>
                        <li><a href="">Science</a></li>
                        <li><a href="">Dogs</a></li>
                    </ul>
                </div>
                <p>341 pages, Hardcover</p>
                <p>First published January 6, 2009</p>
                <div>
                    <h5>This edition</h5>
                    <ul>
                        <li>Format</li>
                        <li>Published</li>
                        <li>ISBN</li>
                        <li>ASIN</li>
                        <li>Language</li>
                    </ul>
                    <ul>
                        <li>341 pages, Hardcover</li>
                        <li>January 1, 2009 by Houghton Mifflin Harcourt</li>
                        <li>9780151014897 (ISBN10: 0151014892)</li>
                        <li>0151014892</li>
                        <li>English</li>
                    </ul>
                </div>
                <?php foreach ($books as $bookDetail): ?>
    <div>
        <h3><?= esc($bookDetail['book']['name']); ?></h3>
        <p>Author: <?= esc($bookDetail['author']['name']); ?></p>
        <p>Category: <?= esc($bookDetail['category']['name']); ?></p>
        <p>Genre: <?= esc($bookDetail['genre']['name']); ?></p>
        <a href="/book/edit/<?= $bookDetail['book']['id']; ?>">Edit</a>
        <a href="/book/delete/<?= $bookDetail['book']['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
    </div>
<?php endforeach; ?>
<a href="/book/create">Add New Book</a>

            </div>
        </section>
    </main>
    <footer>

    </footer>
    
</body>
</html>
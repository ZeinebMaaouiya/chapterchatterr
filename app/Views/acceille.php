<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <script defer src="<?= base_url('js/main.js') ?>"></script>

</head>
<body class="acctuelle">
    <nav class="sidebar" id="sb">
        <div class="text">Service</div>
        <ul id="cont">
            <li>
                <a href="#" id="admin-btn" class="admin-btn"> Service 
                    <i id="first" class="fa-solid fa-caret-down"></i>
                </a>
                <ul id="admin-show" class="admin-show"> <!-- Fixed trailing space -->
                    <li><a href="#">Reclamation</a></li>
                    <li><a href="#">Rendez-vous</a></li>
                </ul>
            </li>
            <li><a href="#">Accueil</a></li>
            <li><a href="#">Emplois des services</a></li>
            <li><a href="#">À propos</a></li>
            <li><a href="/login">Log-in</a></li>
        </ul>
    </nav>

    <header>
        <div id="btn" class="btn">
            <i class="fa-sharp fa-solid fa-bars"></i>
        </div>
        <h1>chapter<span>Chatter</span></h1>
        <div class="divIcone">
            <input type="search" placeholder=" search">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <div class="signe">
            <p> <a href="/login">signe in</a></p>
            <i class="fa-solid fa-user"></i>
        </div>
    </header>
    <main>
        <h1> what will you discover ?</h1>
        <div>
            <div>
                <p>Because meagan liked...</p>
                <p> she discoverd:</p>
            </div>
            <ul>
                <li><a href=""><img src="<?=base_url('/img/ART/how.to.sing.a.song.jpg')?>" alt=""></a></li>
                <li class="item2"><a href=""><img src="<?=base_url('/img/ART/200982318._SX318_.jpg')?>" alt=""></a></li>
                <li class="item3"><a href=""><img src="<?=base_url('/img/ART/lesser.ruins.a.novel.jpg')?>" alt=""></a></li>
                <li class="item4"><a href=""><img src="<?=base_url('/img/ART/taylor.swift.style.jpg')?>" alt=""></a></li>
                <li class="item5" ><a href=""><img src="<?=base_url('/img/ART/the.art.of.crime.jpg')?>" alt=""></a></li>
                <li class="item6"><a href=""><img src="<?=base_url('/img/ART/the.book.of.purrs.jpg')?>" alt=""></a></li>
                <li><i class="fa-solid fa-right"></i></li>
                <li><a href=""><img src="<?=base_url('/img/ART/vivienne.jpg')?>" alt=""></a></li>
            </ul>
        </div>
        <div>
            <div>
                <p>Because meagan liked...</p>
                <p> she discoverd:</p>
            </div>
            <ul>
                <li><a href=""><img src="/img/HORROR/absolution.jpg" alt=""></a></li>
                <li class="item2"><a href=""><img src="/img/HORROR/I.will.be.waiting.jpg" alt=""></a></li>
                <li class="item3"><a href=""><img src="/img/HORROR/the.book.of.witching.jpg" alt=""></a></li>
                <li class="item4"><a href=""><img src="/img/HORROR/the.book.of.witching.jpg" alt=""></a></li>
                <li class="item5"><a href=""><img src="/img/HORROR/model.home.jpg" alt=""></a></li>
                <li class="item6 "><a href=""><img src="/img/HORROR/if.i.stopped.haunting.you.jpg" alt=""></a></li>
                <li><i class="fa-solid fa-right"></i></li>
                <li><a href=""><img src="/img/HORROR/the.bog.wife.jpg" alt=""></a></li>
            </ul>
        </div>
        <div>
            <div>
                <p>Because meagan liked...</p>
                <p> she discoverd:</p>
            </div>
            <ul>
                <li><a href=""><img src="/img/PSYCHOLOGY/american.scary.jpg" alt=""></a></li>
                <li class="item2"><a href=""><img src="/img/PSYCHOLOGY/how.to.date.a.foreigner.jpg" alt=""></a></li>
                <li class="item3" ><a href=""><img src="/img/PSYCHOLOGY/dopamine.jpg" alt=""></a></li>
                <li class="item4" ><a href=""><img src="/img/PSYCHOLOGY/how.to.winter.jpg" alt=""></a></li>
                <li class="item5"><a href=""><img src="/img/POETRY/deer.run.home.jpg" alt=""></a></li>
                <li class="item6" ><a href=""><img src="/img/POETRY/eat.the.world.jpg" alt=""></a></li>
                <li><i class="fa-solid fa-right"></i></li>
                <li><a href=""><img src="/img/POETRY/she.followed.the.moon.back.to.herself.jpg" alt=""></a></li>
            </ul>
        </div>
    </main>
    <footer> 
        <div class=frst>
            <img src="">
            <p> </p>
        </div>
        <div class="ft">
            <div class="contact">
                <h3> contactez-Nous</h3>
                <ul>
                    <li class="i1">
                        <i class="fa-solid fa-phone"></i>
                        <p>+212 715255537</p>
                    </li>
                    <li class="i2">
                        <i class="fa-solid fa-envelope"></i>
                        <a href="">chappterchatter@gmail.com</a>
                    </li>
                    <li class="i3">
                        <i class="fa-solid fa-house"></i>
                        <a href="">adress</a>
                    </li>
                    
                </ul>
            </div>

            <div>
                <h3> suivez-Nous</h3>
                <ul>
                    <li class="l1">
                        <i class="fa-brands fa-facebook-f"></i>
                        <a href="">facebook</a>
                    </li>
                    <li class="l2">
                        <i class="fa-brands fa-instagram"></i>
                        <a href="">instagram</a>
                    </li>
                    <li class="l4">
                        <i class="fa-brands fa-whatsapp"></i>
                        <a href="">whatssap</a>
                    </li>
                    
                </ul>
            </div>

            <div>
                <h3>aide </h3>
                <ul>
                    <li class="l1">
                        <a href="">Q&R</a>
                    </li>
                    <li class="l2">
                    
                        <a href="">a posé une question</a>
                    </li>
                    <li class="l4">
                        <a href="{{route('home.apropos')}}">information</a>
                    </li>
                    
                </ul>
            </div>

        </div>
        <div class=" last">
            <p class=" p">
                <span><i class="fa-regular fa-copyright"></i>  </span>
                 copyright.2024 || chapter chatter
            </p>
        </div>
   </footer>

</body>
</html>
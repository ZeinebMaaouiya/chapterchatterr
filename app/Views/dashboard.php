<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Bienvenue, <?= session('user')['nom'] ?> <?= session('user')['prenom'] ?>!</h1>
<a href="/logout">Déconnexion</a>

</body>
</html>
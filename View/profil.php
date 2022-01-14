<?php
require_once('../Controller/Card.php');
require_once('../Controller/Grille.php');
require_once('../Controller/Securite.php');
require_once('../Controller/Toolbox.php');
require_once('../Database/DB_connection.php');
require_once('../Controller/User.php');
session_start();

//affiche les infos profil
if (isset($_SESSION['objet_utilisateur'])) {
    $objet_user_info = $_SESSION['objet_utilisateur']->info_user();
}

//modifier les infos profil
if (isset($_POST['submit'])) {
    if (!empty($_POST['login']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['email'])) {
        $_SESSION['objet_utilisateur']->modifier_profil_user($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['email']);
    } else {
        Toolbox::ajouterMessageAlerte("Remplir tous les champs.", Toolbox::COULEUR_ROUGE);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../public/css/profil.css">
    <link rel="stylesheet" href="../public/css/header.css">
</head>

<body>

    <header>
        <nav>
            <ul class="navigation">
                <li><a href="../index.php">Home</a></li>
                <li><a href="#about">Top10</a></li>
                <li><a href="./deconnexion.php">Deconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <div class="form_profil">
                <?php require_once(__DIR__ . '/gestion_erreur.php'); ?>

                <h2>Mon profil : </h2>

                <form action="profil.php" method="post">

                    <input type="text" name="login" value="<?= $objet_user_info['login'] ?>" autocomplete="off">

                    <input type="text" name="prenom" value="<?= $objet_user_info['prenom'] ?>" autocomplete="off">

                    <input type="text" name="nom" value="<?= $objet_user_info['nom'] ?>" autocomplete="off">

                    <input type="text" name="email" value="<?= $objet_user_info['email'] ?>" autocomplete="off">

                    <button type="submit" name="submit">Modifier</button>
                </form>

            </div>

        </section>
    </main>
    <footer>

    </footer>

</body>

</html>
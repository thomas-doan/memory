<?php
require_once(__DIR__ . '/../model/Register_Login_model.php');
require_once(__DIR__ . '/../controller/Toolbox.php');
require_once(__DIR__ . '/../controller/Securite.php');
require_once(__DIR__ . '/../database/DB_connection.php');

session_start();

if (Securite::estConnecte()) {
    header('Location:../index.php');
}

if (isset($_POST['submit'])) {
    if (!empty($_POST['login']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        Register::register_utilisateur($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['password']);
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
    <title>Memory Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../public/css/inscription_connexion.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/footer.css">
</head>

<body>

    <header>
        <nav>
            <ul class="navigation">
                <li><a href="../index.php">Memory</a></li>
                <li><a href="./connexion.php">Connexion</a></li>
            </ul>
        </nav>
    </header>
    <main>

        <section>
            <div class="form_register">
                <?php require_once(__DIR__ . '/gestion_erreur.php'); ?>

                <h2>Inscription</h2>

                <form action="inscription.php" method="post">

                    <input type="text" name="login" placeholder="Login" autocomplete="off">

                    <input type="text" name="prenom" placeholder="Prenom" autocomplete="off">

                    <input type="text" name="nom" placeholder="Nom" autocomplete="off">

                    <input type="text" name="email" placeholder="Email" autocomplete="off">

                    <input type="password" name="password" placeholder="Votre mot de passe" autocomplete="off">

                    <button type="submit" name="submit">Valider</button>
                </form>

            </div>

        </section>

    </main>
    <?php require_once(__DIR__ . '/footer.php'); ?>

</body>

</html>
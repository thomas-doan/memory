<?php
require('../Controller/Register.php');
require('../Controller/Toolbox.php');
require('../Controller/Securite.php');
session_start()

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Inscription</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../public/css/inscription.css">
    <link rel="stylesheet" href="../public/css/header.css">
</head>

<body>

    <header>
        <nav>
            <ul class="navigation">
                <li><a href="../index.php">Home</a></li>
                <li><a href="#about">Top10</a></li>
                <li><a href="./connexion.php">Connexion</a></li>
            </ul>
        </nav>
    </header>
    <main>

        <section>
            <div class="form_register">

                <h2>Inscription</h2>

                <form action="inscription.php" method="post">

                    <input type="text" name="login" placeholder="Login" autocomplete="off">

                    <input type="text" name="prenom" placeholder="Prenom" autocomplete="off">

                    <input type="text" name="nom" placeholder="Nom" autocomplete="off">

                    <input type="text" name="email" placeholder="Email" autocomplete="off">

                    <input type="password" name="password" placeholder="Votre mot de passe" autocomplete="off">



                    <button type="submit" name="submit">Valider</button>
            </div>
            </form>
        </section>

        </form>
        </div>



    </main>
    <footer>

    </footer>

</body>

</html>
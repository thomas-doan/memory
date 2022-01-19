<?php
require_once(__DIR__ . '/../controller/Card.php');
require_once(__DIR__ . '/../controller/Grille.php');
require_once(__DIR__ . '/../controller/Securite.php');
require_once(__DIR__ . '/../controller/Toolbox.php');
require_once(__DIR__ . '/../database/DB_connection.php');
require_once(__DIR__ . '/../controller/User.php');
require_once(__DIR__ . '/../controller/Score.php');
session_start();

if (!Securite::estConnecte()) {
    header('Location:../index.php');
}

if (isset($_SESSION['profil'])) {
    $id_session = $_SESSION['profil']['id'];
}

if (isset($_POST['top'])) {
    $pair = $_POST['top'];
    $score_top10 = $_SESSION['objet_score']->affiche_score_top10($pair);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Top10</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../public/css/top.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/footer.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>
    <div class="container_general">
        <header>
            <nav>
                <ul class="navigation">
                    <li><a href="../index.php">Memory</a></li>
                    <li><a href="./profil.php">Profil</a></li>
                    <li><a href="./deconnexion.php">Logout</a></li>
                </ul>
            </nav>
        </header>
        <main>

            <div class="dashboard">
                <form method='POST' action=''>
                    <p>classement Nombres de paires :</p>
                    <select name="top">

                        <option value="">Choisir vos nombres de paires</option>
                        <?php for ($i = 3; $i <= 12; $i++) {
                        ?>
                            <option value=<?= $i ?>><?= $i ?></option>
                        <?php } ?>

                    </select>
                    <button type='submit'>
                        OK
                    </button>

                </form>

                <?php if (isset($_POST['top'])) { ?>
                    <section>
                        <table data-aos="fade-left">
                            <caption>Wall of fame </caption>

                            <tr>
                                <th>Position</th>
                                <th>Pseudo</th>
                                <th>Nombre de pair</th>
                                <th>score</th>
                            </tr>
                            <?php foreach ($score_top10 as $key => $value) { ?>

                                <tr>
                                    <td>N° <?= $key + 1 ?></td>
                                    <td><?= $value['login'] ?>s</td>
                                    <td><?= $value['nombre_pair'] ?></td>
                                    <td><?= $value['temps_score'] ?>s</td>
                                </tr>

                            <?php } ?>

                        </table>
                    </section>
                <?php } ?>

            </div>



        </main>
        <?php require_once(__DIR__ . '/footer.php'); ?>
    </div>

    <script>
        AOS.init({
            duration: 1000,

        })
    </script>
</body>

</html>
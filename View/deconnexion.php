<?php
require_once('../Controller/User.php');
require_once('../Controller/Securite.php');
session_start();

if (!Securite::estConnecte()) {
    header('Location:../index.php');
    exit();
} else {
    $_SESSION['objet_utilisateur']->deconnexion();
    header('Location:../index.php');
    exit();
}

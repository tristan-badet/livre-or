<?php

require 'Classes/database.php';

require 'Classes/ClasseConnexion.php';

session_start();
$database = new Database();
$auth = new Auth($database);

if (isset($_POST["bouton_confirmer"])) {
    $conn = $auth->login($_POST["login"], $_POST["password"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
    <header>
        <a href="../index.php">Accueil</a>
        <a href="livre-or.php">Livre d'or</a>
        <a href="connexion.php">Connexion</a>
        <a href="inscription.php">Inscription</a>
    </header>
</head>

<body>
    <section class="informations">
        <form action="connexion.php" method="post" id="formulaire_inscription_et_connexion">
            <h1>Connexion</h1>
            <div>
                Nom d'utilisateur :<br> <input type="text" name="login" id="login">
            </div>
            <div>
                Mot de passe:<br> <input type="password" name="password" id="password">
            </div>
            <div>
                <?php
                if (isset($_POST["login"])) {
                    if (empty($auth->error)) {
                        echo $auth->message;
                    } else {
                        echo $auth->error;
                    }
                }
                ?>
            </div>
            <div>
                <button type="submit" class="bouton_confirmer" name="bouton_confirmer">Confirmer</button>
            </div>
            <div>

                Vous n'avez pas encore de compte ?<br> <a href="inscription.php">Inscrivez-vous</a>
            </div>
        </form>
    </section>
</body>

</html>

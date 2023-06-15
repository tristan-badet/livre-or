<?php

require 'Classes/database.php';

require 'Classes/ClasseInscription.php';

session_start();
$database = new Database();
$register = new Register($database);

if (isset($_POST["bouton_confirmer"])){
    $login = $_POST["login"];
    $password = $_POST["password"];
    $register->createAccount($login, $password);
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
<form action="inscription.php" method="post" id="formulaire_inscription_et_connexion">
    <h1>Inscription</h1>
    <div>
        Nom d'utilisateur :<br> <input type="text" name="login" id="login">
    </div>
    <div>
        Mot de passe :<br> <input type="password" name="password" id="password">
    </div>
    <div>
        Confirmation du mot de passe :<br> <input type="password" name="password_confirmation" id="password_confirmation">
    </div>
    <div>
    <button type="submit" class="bouton_confirmer" name="bouton_confirmer">Confirmer</button>
    </div>
    <div>
        <p><?php 
        if(!empty($register->error)) {echo $register->error;}elseif(!empty($register->message)) {echo $register->message;  header( "refresh:1;url=connexion.php" );}
        ?></p>
</div>
    <div>
    Êtes-vous déjà inscrit ?<br> <a href="connexion.php">Connectez-vous</a>
    </div>
</form>
</section>
</body>
</html>
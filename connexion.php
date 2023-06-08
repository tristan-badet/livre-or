<?php
session_start();
$bdd = new PDO ('mysql:host=localhost;dbname=livreor', 'root', '');
$error = "";
if(isset($_POST["login"])){
    if(empty($_POST["login"]) || empty($_POST["password"])){
        $error = "Veuillez remplir les champs.";
    } else {
        $query = $bdd->prepare('SELECT * FROM user WHERE login = ?');
        $query->execute(array($_POST["login"]));
        $count = $query->rowCount();
        if ($count > 0){
            $result = $query->fetchAll();
            foreach($result as $valeur){
                if(password_verify($_POST["password"], $valeur["password"])){
                    $message = "Connexion effectuée, veuillez patienter.";
                    $_SESSION["Connection"] = true;
                    $_SESSION["login"] = $valeur['login'];
                    $_SESSION["id"] = $valeur["id"];
                    header("refresh:2;index.php");
                }else{
                    $error = "Mauvais mot de passe";
                }
            }
            }else{
                $error = "Mauvais identifiant";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <header>
    <a href="index.php">Accueil</a>
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
        if (isset($_POST["login"])){
        if(empty($error)){echo $message;}else{echo $error;}}
        ?>
</div>
    <div>
    <button type="submit" class="bouton_confirmer">Confirmer</button>
    </div>
    <div>
        
    Vous n'avez pas encore de compte ?<br> <a href="inscription.php">Inscrivez-vous</a>
    </div>
</form>
</section>
</body>
</html>
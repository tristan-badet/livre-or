<?php

$bdd = new PDO ('mysql:host=localhost;dbname=livreor', 'root', '');

if (isset($_POST["login"])){
    $login = $_POST["login"];
}

if (isset($_POST["password"])){
    $password = $_POST["password"];
}

if(isset($_POST["password_confirmation"])){
    $password_confirmation = $_POST["password_confirmation"];
}



if (isset($_POST["password"]) && isset($_POST["password_confirmation"])){
    if ($_POST["password"] === $_POST["password_confirmation"]){
        $password = $_POST["password"];
        
        $upper_case = preg_match('@[A-Z]@', $password);
        $lower_case = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $special_ch = preg_match('@[^\w]@', $password);
            if (!$upper_case || !$lower_case || !$number || !$special_ch ||strlen($password) < 8){
                $error = "Votre mot de passe ne correspond pas aux mesures de sécurité";
            }else{
                $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            }
     } else {
        $error = "Vos mots de passes ne correspondent pas";
     }
    }



if (isset($_POST["login"])){
$query = $bdd->prepare('SELECT * FROM user WHERE login = ?');
$query->execute([$login]);
$result = $query->rowCount();
if($result > 0){
    $error = "Ce compte existe déjà";
} 

if(empty($error)){
    $query = $bdd->prepare("INSERT INTO user(login, password) VALUES(:login, :password)");
    $query->bindParam(':login', $login, PDO::PARAM_STR,255);
    $query->bindParam(':password', $password, PDO::PARAM_STR, 255);
    $query->execute();
    $message = "Votre compte a bien été créé";
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
<section>
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
    <button type="submit" class="bouton_confirmer">Confirmer</button>
    </div>
    <div>
        <p><?php 
        if (isset($_POST["login"])){
        if(empty($error)){echo $message; header( "refresh:1;url=connexion.php" );}else{echo $error;}}
        ?></p>
</div>
    <div>
    Êtes-vous déjà inscrit ?<br> <a href="connexion.php">Connectez-vous</a>
    </div>
</form>
</section>
</body>
</html>
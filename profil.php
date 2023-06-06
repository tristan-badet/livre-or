<?php
session_start();
if(isset($_POST['deconnect_button'])) {
session_unset();
session_destroy();
header("location:connexion.php");
exit;
}

$bdd = new PDO ('mysql:host=localhost;dbname=livreor', 'root', '');


$old_login = $_SESSION["login"];

if (isset($_POST["nom_utilisateur"])){
    $new_login = $_POST["nom_utilisateur"];
    $_SESSION["login"] = $_POST["nom_utilisateur"];
} else {
    $new_login = $_SESSION["login"];
}





if(isset($_POST["submit_bouton"])){
    $requete = $bdd->prepare('UPDATE user SET login=?, password=? WHERE login=?');
    $requete->execute([$new_login,  $old_login]);
    header("refresh:1;index.php");
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <header>
    <a href="index.php">Accueil</a>
    <a href="livre-or.php">Livre d'or</a>
    <?php if (isset($_SESSION["Connection"]) && $_SESSION["Connection"] == true) {?>
            <a href="commentaire.php">Commentaire</a>
            <a href="profil.php">Profil</a>
            <form method="post" action="index.php">
            <button type="submit" name="deconnect_button" value="disconnect">Déconnexion</button>
            </form>
            <?php } else { ?>
                <a href="connexion.php">Connexion</a>
            <a href="inscription.php">Inscription</a>
                <?php } ?>
    </header>
</head>
<body>
<section>
    <form action="profil.php" method="post">
    <h1>Modification du Profil</h1>
    <div>
        Nom d'utilisateur :<br> <input type="text" name="nom_utilisateur" id="nom_utilisateur" value="<?php echo $_SESSION["login"];?>">
    </div>
    
    <div><?php 
        if (isset($_POST["submit_bouton"])){
        if(empty($message_confirmation)){echo "";}else{echo $message_confirmation;}}
        ?></div>
    <div>
    <button type="submit" class="bouton_confirmer" name="submit_bouton" id="submit_bouton">Confirmer</button>
    </div>
</form>
</section>
</body>
</html>
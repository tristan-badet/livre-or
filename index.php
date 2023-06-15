<?php
session_start();
if(isset($_POST['deconnect_button'])) {
session_unset();
session_destroy();
header("location:template/connexion.php");
exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>FFinally</title>
    <header>
    <a href="index.php">Accueil</a>
    <a href="template/livre-or.php">Livre d'or</a>
    <?php if (isset($_SESSION["Connection"]) && $_SESSION["Connection"] == true) {?>
            <a href="template/commentaire.php">Commentaire</a>
            <a href="template/profil.php">Profil</a>
            <form method="post" action="index.php">
            <button type="submit" name="deconnect_button" value="deconnect_button">Déconnexion</button>
            </form>
            <?php } else { ?>
                <a href="template/connexion.php">Connexion</a>
            <a href="template/inscription.php">Inscription</a>
                <?php } ?>
    </header>
</head>
<body>
<section class="informations">
    <h1>Bienvenue !</h1>
    <br>
    <p>Heureux de vous accueillir sur FFinally, endroit où se regroupent les fans de la licence Final Fantasy. Fais partager ta passion auprès des autres membres de la communauté</p>
    <p><em>- Les petits pampas</em></p>
    <p>
        N'hésitez pas à nous rejoindre sur les réseaux afin d'être au courant des dernières nouveautés !
    </p>
    <br>      
        <img src="template/assets/facebook.png" alt="logo facebook"> 
        <img src="template/assets/instagram.png" alt="logo instagram">  
        <img src="template/assets/linkedin.png" alt="logo linkedin"> 
        <img src="template/assets/twitter.png" alt="logo twitter">  
        <img src="template/assets/youtube.png" alt="logo youtube">
</section>
</body>
</html>
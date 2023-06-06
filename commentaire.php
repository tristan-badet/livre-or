<?php
session_start();
if(isset($_POST['deconnect_button'])) {
session_unset();
session_destroy();
header("location:connexion.php");
exit;
}
$bdd = new PDO ('mysql:host=localhost;dbname=livreor', 'root', '');
$error = "";
if (isset($_POST["create_comment"])){
    $comment = $_POST["create_comment"];
}
$date = date("Y-m-d");

if (isset($_SESSION["id"])){
    $id_user = $_SESSION["id"];
}
if (isset($_POST["create_comment"]) && isset($_POST["create_comment_button"])){
    if(!empty($id_user)){
    $query = $bdd->prepare("INSERT INTO comment(comment, id_user, date) VALUES (:comment, :id_user, :date)");
    $query->bindParam(':comment', $comment, PDO::PARAM_STR);
    $query->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    $query->execute();
    $message = "Votre commentaire a bien été ajouté.";
    }
}
$query = $bdd->prepare('SELECT * FROM comment');
$query->execute();
$comments = $query->fetchall();
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
    <form action="commentaire.php" method="POST">
                <input type="text" id="create_comment" name="create_comment">
                <button type="submit" name="create_comment_button" value="create_comment_button">Commenter</button>
    </form>
</body>
</html>
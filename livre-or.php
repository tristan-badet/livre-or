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
$query = $bdd->prepare('SELECT * FROM comment ORDER BY date DESC');
$query->execute();
$comments = $query->fetchall();
$query2 = $bdd->prepare('SELECT login FROM user JOIN comment ON user.id = comment.id_user');
$query2->execute();
$username = $query2->fetchAll();
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
<?php
foreach ($comments as $index => $comment) {
    $username = isset($username[$index]['login']) ? $username[$index]['login'] : '';
    ?>
    <div>
        <p>Posté par <?php echo $username . " le " . $comment['date']; ?></p>
    </div>
    <div>
        <p><?php echo $comment['comment']; ?></p>
    </div>
<?php } ?>
</body>
</html>
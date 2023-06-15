<?php
session_start();
if(isset($_POST['deconnect_button'])) {
session_unset();
session_destroy();
header("location:connexion.php");
exit;
}
require 'Classes/database.php';

require 'Classes/ClasseLivreOr.php';

$database = new Database();
$goldenBook = new GoldenBook($database);
$data = $goldenBook->getComments();

$comments = $data['comments'];
$usernames = $data['usernames'];
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
    <?php if (isset($_SESSION["Connection"]) && $_SESSION["Connection"] == true) {?>
            <a href="commentaire.php">Commentaire</a>
            <a href="profil.php">Profil</a>
            <form method="post" action="../index.php">
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
    $actual_username = isset($usernames[$index]) ? $usernames[$index] : '';
    ?>
    <section class="comment_section">
    <div>
        <p><b>Posté par <?php echo $actual_username . " le " . $comment['date']; ?></b></p>
    </div>
    <div>
        <p class="comment_section_message"><?php echo $comment['comment']; ?></p>
    </div>
    </section>
<?php } ?>
</body>
</html>
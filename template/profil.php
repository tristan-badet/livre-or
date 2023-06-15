<?php
require 'Classes/database.php';

require 'Classes/ClasseProfil.php';

session_start();

$old_login = $_SESSION["login"];

if (isset($_POST["bouton_confirmer"])){
    $new_login = $_POST["user_name"];
    $_SESSION["login"] = $_POST["user_name"];
    $password = $_POST["password"];
    $password_confirmation = $_POST['password_confirmation'];
    $database = new Database();
    $modify = new Modify($database);
    $conn = $modify->modifyProfile($new_login, $password, $old_login, $password_confirmation);
} else {
    $new_login = $_SESSION["login"];
}
    
if(isset($_POST['deconnect_button'])) {
    session_unset();
    session_destroy();
    header("location:connexion.php");
    exit;
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
<section class="informations">
    <form method="post">
    <h1>Modification du Profil</h1>
    <div>
        Nom d'utilisateur :<br> <input type="text" name="user_name" id="user_name" value="<?php echo $_SESSION["login"];?>">
    </div>
    <div>
        Changer de mot de passe :<br> <input type="password" name="password" id="password">
    </div>
    <div>
        Confirmation du mot de passe : <br> <input type="password" name="password_confirmation" id="password_confirmation">
    </div>
    
    <div><?php 
        if(!empty($modify->error)) {echo $modify->error;}elseif(!empty($modify->message)) {echo $modify->message;}
        ?></div>
    <div>
    <button type="submit" name="bouton_confirmer" id="bouton_confirmer">Confirmer</button>
    </div>
    </form>
</section>
</body>
</html>

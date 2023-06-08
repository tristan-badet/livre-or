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

if (isset($_POST["user_name"])){
    $new_login = $_POST["user_name"];
    $_SESSION["login"] = $_POST["user_name"];
} else {
    $new_login = $_SESSION["login"];
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





if(isset($_POST["submit_bouton"])){
    $query = $bdd->prepare('UPDATE user SET login=? WHERE login=?');
    $query->execute([$new_login,  $old_login]);
        if(empty($error)){
            $query2 = $bdd->prepare("UPDATE user SET password=? WHERE login=?");
            $query2->execute([$password, $new_login]);
            $message = "Votre mot de passe a bien été changé";
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
        if (isset($_POST["submit_bouton"])){
        if(empty($message)){echo "";}else{echo $message;}}
        ?></div>
    <div>
    <button type="submit" name="submit_bouton" id="submit_bouton">Confirmer</button>
    </div>
</form>
</section>
</body>
</html>
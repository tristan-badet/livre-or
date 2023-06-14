<?php

require 'database.php';


class Register {

    private $database;
    public $message;
    public $error;

    public function __construct($database){
        $this->database = $database;
        $this->message = "";
        $this->error = "";
    }
    public function createAccount($login, $password){
        
        $bdd = $this->database->getBdd();

      
        if (isset($_POST["password"]) && isset($_POST["password_confirmation"])){
            if ($_POST["password"] === $_POST["password_confirmation"]){
                $password = $_POST["password"];
                
                $upper_case = preg_match('@[A-Z]@', $password);
                
                $lower_case = preg_match('@[a-z]@', $password);
                $number    = preg_match('@[0-9]@', $password);
                $special_ch = preg_match('@[^\w]@', $password);
                    if (!$upper_case || !$lower_case || !$number || !$special_ch ||strlen($password) < 8){
                        $this->error = "Votre mot de passe ne correspond pas aux mesures de sécurité";
                    }else{
                        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    }
            } else {
                $this->error = "Vos mots de passes ne correspondent pas";
            }
            }

        if (isset($_POST["login"])){
        $query = $bdd->prepare('SELECT * FROM user WHERE login = ?');
        $query->execute([$login]);
        $result = $query->rowCount();
        if($result > 0){
            $this->error = "Ce compte existe déjà";
        } 

        if(empty($this->error)){
            $query = $bdd->prepare("INSERT INTO user(login, password) VALUES(:login, :password)");
            $query->bindParam(':login', $login, PDO::PARAM_STR,255);
            $query->bindParam(':password', $password, PDO::PARAM_STR, 255);
            $query->execute();
            $this->message = "Votre compte a bien été créé";
        }
        }
        }
    }
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
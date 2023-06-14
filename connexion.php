<?php

require 'database.php';

class User{
    private $login;
    private $password;
    private $id;

    public function __construct($login, $password, $id){
        $this->login = $login;
        $this->password = $password;
        $this->id = $id;
    }

    public function getLogin(){
        return $this->login;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getId(){
        return $this->id;
    }
}

class Auth{
    private $database;
    public $message;
    public $error;

    public function __construct($database){
        $this->database = $database;
        $this->message = "";
        $this->error = "";
    }

    public function login($login, $password){
        $bdd = $this->database->getBdd();

        if (empty($login) || empty($password)) {
            $this->error = "Veuillez remplir les champs.";
        } else {
            $query = $bdd->prepare('SELECT * FROM user WHERE login = ?');
            $query->execute(array($login));
            $count = $query->rowCount();

            if ($count > 0) {
                $result = $query->fetchAll();

                foreach ($result as $valeur) {
                    if (password_verify($password, $valeur["password"])) {
                        $this->message = "Connexion effectuée, veuillez patienter.";
                        $_SESSION["Connection"] = true;
                        $_SESSION["login"] = $valeur['login'];
                        $_SESSION["id"] = $valeur["id"];
                        header("refresh:2;index.php");
                    } else {
                        $this->error = "Mauvais mot de passe";
                    }
                }
            } else {
                $this->error = "Mauvais identifiant";
            }
        }

        return $this->error;
    }
}

session_start();
$database = new Database();
$auth = new Auth($database);

if (isset($_POST["bouton_confirmer"])) {
    $conn = $auth->login($_POST["login"], $_POST["password"]);
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
                if (isset($_POST["login"])) {
                    if (empty($auth->error)) {
                        echo $auth->message;
                    } else {
                        echo $auth->error;
                    }
                }
                ?>
            </div>
            <div>
                <button type="submit" class="bouton_confirmer" name="bouton_confirmer">Confirmer</button>
            </div>
            <div>

                Vous n'avez pas encore de compte ?<br> <a href="inscription.php">Inscrivez-vous</a>
            </div>
        </form>
    </section>
</body>

</html>

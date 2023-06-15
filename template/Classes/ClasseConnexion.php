<?php

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
                        header("refresh:2;../index.php");
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

?>
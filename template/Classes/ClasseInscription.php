<?php

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

?>
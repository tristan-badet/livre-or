<?php

class Modify {

    private $database;
    public $error;
    public $message;

    public function __construct($database){
        $this->database = $database;
        $this->message = "";
        $this->error = "";
    }

    public function modifyProfile($new_login, $password, $old_login, $password_confirmation){

        $bdd = $this->database->getBdd();

        if (!empty($password) && $password === $password_confirmation){
                $upper_case = preg_match('@[A-Z]@', $password);
                $lower_case = preg_match('@[a-z]@', $password);
                $number = preg_match('@[0-9]@', $password);
                $special_ch = preg_match('@[^\w]@', $password);
                if (!$upper_case || !$lower_case || !$number || !$special_ch ||strlen($password) < 8){
                    $this->error = "Votre mot de passe ne correspond pas aux mesures de sécurité";
                    return false;
                }
                $passwordHashed = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $query2 = $bdd->prepare("UPDATE user SET password=? WHERE login=?");
                $query2->execute([$passwordHashed, $old_login]);
                $this->message = "Votre mot de passe a bien été changé";
                if(!empty($new_login) && $new_login !== $old_login){
                    $query = $bdd->prepare('UPDATE user SET login=? WHERE login=?');
                    $query->execute([$new_login,  $old_login]);
                    $_SESSION["login"] = $new_login;
                    $this->message = "Vos informations ont bien été changées";
                    }
            } else {
                $this->error = "Vos mots de passe ne correspondent pas";
                return false;
            }return true;
        }
    }

    ?>
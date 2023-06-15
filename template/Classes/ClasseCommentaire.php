<?php

class CreateComment {

    private $database;

    public function __construct($database){
        $this->database = $database;
    }

    public function addComment($comment, $id_user){

        $bdd = $this->database->getBdd();
        $date = date("Y-m-d");
        $query = $bdd->prepare("INSERT INTO comment(comment, id_user, date) VALUES (:comment, :id_user, :date)");
        $query->bindParam(':comment', $comment, PDO::PARAM_STR);
        $query->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
        $query->execute();
    }
}

?>
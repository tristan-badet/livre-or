<?php

class GoldenBook{
    private $database;

    public function __construct($database){
        $this->database = $database;
    }

    public function getComments() {
        $bdd = $this->database->getBdd();
        $error = "";
        $query = $bdd->prepare('SELECT * FROM comment ORDER BY date DESC');
        $query->execute();
        $comments = $query->fetchall();
        $query2 = $bdd->prepare('SELECT login FROM user JOIN comment ON user.id = comment.id_user ORDER BY comment.date DESC');
        $query2->execute();
        $usernames = $query2->fetchAll(PDO::FETCH_COLUMN);
        return array('comments' => $comments, 'usernames' => $usernames);
    }
}

?>
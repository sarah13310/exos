<?php
require_once("xena/Model.php");
require_once("User.php");

class ModelUser extends \xena\Model
{

    public function __construct()
    {
        $this->getConnection("mydatabase");
    }

    public function insertUser(User $user)
    {
        $this->setTable("users");
        $sql = "INSERT INTO {$this->getTable()} ('name','firstname','birthday','gender','langages','mail','password')
VALUES(
        {$user->getName()},
        {$user->getFirstname()},
        {$user->getBirthday()},
        {$user->getGenre()},
        {$user->getInfos()->getLangages()},
        {$user->getInfos()->getMail()},
        {$user->getInfos()->getMail()}
       )";
        $this->connection->prepare($sql);
        $this->connection->execute();
    }
}

$usr = new ModelUser();

$status = $usr->getStatus();
//echo $status["status"];
//echo $status["connexion"];
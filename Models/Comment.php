<?php
class Comment extends Model
{
    public function __construct(){
        self::getModel();
    }

    public function getAllComments()
    {
        $query = self::$instance->prepare("SELECT * FROM commentaire");
        $query->execute();
        $comments = $query->fetchAll();

        return $comments;
    }
}

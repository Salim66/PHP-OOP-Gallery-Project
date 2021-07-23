<?php 


// Create user class
class Comment extends DBObject {

    // create class property
    protected static $db_table = "comments";
    protected static $db_table_field = ["id", "photo_id", "author", "body"];
    public $id;
    public $photo_id;
    public $author;
    public $body;


    // Create comment method
    public static function createComment($photo_id, $author, $body){
        
        if(!empty($photo_id) && !empty($author) && !empty($body)){
            // Create Commnet class Instantiate
            $comment = new Comment();

            $comment->photo_id = (int)$photo_id;
            $comment->author   = $author;
            $comment->body     = $body;

            return $comment;
        }else {
            return false;
        }

    }

}
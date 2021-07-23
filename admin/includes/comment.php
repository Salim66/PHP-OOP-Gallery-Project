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


}
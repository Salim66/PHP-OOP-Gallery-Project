<?php 

// Create photo class
class Photo extends DBObject {

    // create class property
    protected static $db_table = "photos";
    protected static $db_table_field = ["photo_id", "title", "description", "filename", "type", "size"];
    public $photo_id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size; 





}





?>
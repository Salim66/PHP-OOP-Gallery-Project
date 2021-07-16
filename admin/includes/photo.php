<?php 

// Create photo class
class Photo extends DBObject {

    // create class property
    protected static $db_table = "photos";
    protected static $db_table_field = ["title", "description", "filename", "type", "size"];
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size; 





}





?>
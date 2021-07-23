<?php 


// Create user class
class User extends DBObject {

    // create class property
    protected static $db_table = "users";
    protected static $db_table_field = ["username", "password", "first_name", "last_name", "user_image"];
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name; 
    public $user_image; 
    public $upload_directory = "images"; 
    public $image_placeholder = "http://placehold.it/400x400&text=image"; 



    /**
     * User Image path and Placeholder method
     */
    public function imagePathAndPlaceholder(){
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
    }



   
    /**
     * User verify from the database
     */
    public static function verify_user($username, $password){
        // before we sending data into database first we clean up the string / unnessary token and symbol
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

         // use this way / this way to more short and clear cord
         $the_result_array = self::findByQuery($sql);
         return !empty($the_result_array)? array_shift($the_result_array) : false;

    }




}